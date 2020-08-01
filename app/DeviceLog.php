<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class DeviceLog extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'content', 'device_id', 'user_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function devices()
    {
    	return $this->belongsTo(Device::class);
    }
}
