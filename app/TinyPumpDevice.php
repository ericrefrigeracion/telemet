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
		'on_mode',
		'l_cal',
		'l_min',
		'l_max',
		'tdly',
		'l_offset',
		'l_is',
		'channel1',
		'channel2',
		'channel3',
		'l_change_at',
		'l_out_at'
    ];

    protected $dates = [
    	'l_change_at',
    	'l_out_at'
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
