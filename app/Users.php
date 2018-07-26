<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'aadhar', 'dob'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['dob','created_at','updated_at'];

    public function address(){
        return $this->hasOne('\App\Address','user_id','id');
    }

    public function blockChainAddr(){
        $attr = $this->attributes;
        return sha1($attr['aadhar'].$attr['dob'].env('SECRET'));
    }
}
