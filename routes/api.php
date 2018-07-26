<?php

use Illuminate\Http\Request;

use \App\Http\Controllers\BlockChainController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['middleware' => 'auth.session'], function () {
    Route::get('/users', function (Request $request) {
        return \App\Users::all();
    });

    Route::get('/state/{state}/city',function(Request $req,$state){
        return \App\Address::select('city')->distinct()->where('state',$state)->get();
    });

    Route::prefix('blockchain')->group(function(){

        Route::get('/info', 'BlockChainController@getInfo');
        Route::get('/new-address', 'BlockChainController@generateAddress');
        Route::get('/grant/{permissions}', 'BlockChainController@grantPermissions');
        Route::prefix('stream')->group(function(){

            Route::get('', 'BlockChainController@getStream');
            Route::get('new/{stream}', 'BlockChainController@newStream');
            Route::get('subscribe/{stream}', 'BlockChainController@subscribeStream');
            Route::post('publish/{stream}', 'BlockChainController@publishStream');
            // Route::get('view/{stream}', 'BlockChainController@viewStreamItems');
            Route::post('view/{stream}','BlockChainController@viewStreamItems');

            Route::get('fake/{stream}','BlockChainController@fakeStream');
        });
    });
});
