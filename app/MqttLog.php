<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class MqttLog extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'device_id', 'log'
    ];

     protected $dates = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function device()
    {
    	return $this->belongsTo(Device::class);
    }
}
