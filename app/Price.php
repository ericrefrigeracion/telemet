<?php

namespace App;

use App\Pay;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'days', 'description', 'price', 'excluded', 'installments', 'type', 'device_mdl',
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

    public function pays()
    {
        return $this->hasMany(Pay::class);
    }
}
