<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class TinyPumpDevice extends Model
{
    protected $fillable = [
        'id',
		'device_id',
		'on_level',
        'status_channel1',
        'status_channel2',
        'status_channel3',
		'l_cal',
		'l_min',
		'l_max',
		'l_offset',
		'l_dly',
		'channel1_min',
        'channel1_max',
		'channel2_min',
        'channel2_max',
		'channel3_min',
        'channel3_max',
		'l_change_at',
		'l_out_at',
        'device_update'
    ];

    protected $dates = [
    	'l_change_at',
    	'l_out_at',
        'device_update'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function device()
    {
    	return $this->belongsTo(Device::class);
    }

}
