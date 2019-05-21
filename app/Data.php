<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data01', 'data02', 'data03', 'data04', 'data05', 'data06', 'data07', 'data08', 'data09', 'data10', 'data11', 'rssi', 'log', 'device_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'id'
    ];

    public function devices()
    {
    	return $this->belongsTo(Device::class);
    }
}
