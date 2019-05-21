<?php

namespace App;

use App\Devices;
use Illuminate\Database\Eloquent\Model;

class DeviceConfiguration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ch1_monitor', 'ch1_min', 'ch1_max', 'ch1_delay', 'ch1_calibration', 'ch2_monitor', 'ch2_min', 'ch2_max', 'ch2_delay', 'ch2_calibration', 'mail_send', 'device_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    public function devices()
    {
    	return $this->belongsTo(Device::class);
    }
}
