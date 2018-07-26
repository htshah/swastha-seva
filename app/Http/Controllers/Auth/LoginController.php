<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        try{
            $request->validate([
                'mobile'=>'required|regex:/[+]{1}[0-9]{12,13}/|exists:users'
            ]);
            $user = \App\Users::where('mobile', $request->mobile)->first();
            
            //Generate OTP
            $otp = mt_rand(1594,9968);
            $request->session()->put([
                'otp' => $otp,
                'user_id' => $user->id,
                'status' => 'VERFYING'
            ]);
            // TextLocal::sendSms([$user->mobile],$msg,'SWSTVA');
            return [
                'success' => 1,
                'message' => 'OTP has been sent to your mobile number.',
                'otp' => $otp,
            ];
        }catch(ValidationException $e){
            return $e->errors();
        }catch(\Exception $e){
            dd($e);
        }
    }

    public function verfiyOtp(Request $request){
        if($request->session()->get('status') != 'VERFYING'){
            return redirect('/home');
        }
        try{
            $request->validate([
                'otp'=>'required|numeric|digits:4'
            ]);
            $sessionOtp = $request->session()->get('otp',NULL);
            if($sessionOtp == null){
                throw new \Exception('Something went wrong',404);
            }
            if($request->otp != $sessionOtp){
                throw new \Exception('Invalid Otp provided',401);
            }
            session([
                'status' => 'AUTHENTICATED',
                'uid'    => \App\Users::find($request->session()->get('user_id'))
                                ->first()->block_address,
            ]);
            return redirect('/home');
        }catch(ValidationException $e){
            return $e->errors();
        }catch(\Exception $e){
            if($e->getCode() == 401){
                return [
                    'errors'=>[
                        'otp' => $e->getMessage(),
                    ],
                ];
            }
            dd($e);
        }
    }
}
