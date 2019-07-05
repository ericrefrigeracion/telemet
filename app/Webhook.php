<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'type', 'user_id', 'application_id', 'version', 'action', 'data', 'date_created'
    ];

     protected $dates = [
     	//
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	//
    ];
}
