<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'created_at','deleted_at'
    ];

    protected $fillable = [
        'street', 'city', 'state', 'pincode', 'user_id'
    ];

    protected $dates = ['created_at','updated_at'];

    /* public function address(){
        return $this->belongsTo('App\Users','user_id','id');
    } */
}
