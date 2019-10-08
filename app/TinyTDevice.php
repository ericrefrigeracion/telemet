<?php

use App\Device;
use App\AllowedSchedule;
use Illuminate\Database\Eloquent\Model;

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinyTDevice extends Model
{
    protected $fillable = [
        'id',
        'device_id',
        'on_temp',
		'on_t_set_point',
		'tdly',
		'tcal',
		't_set_point',
		't_is',
		't_change_at',
		'tmin',
		't_out_at',
		'tmax',
    ];

    protected $dates = [
    	't_change_at',
    	't_out_at'
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