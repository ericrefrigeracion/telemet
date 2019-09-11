<?php

namespace App;

use App\Pay;
use App\TypeDevice;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'days', 'description', 'price', 'excluded', 'installments', 'type_device_id',
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

    public function type_device()
    {
        return $this->belongsTo(TypeDevice::class);
    }
}
