<?php

namespace App;

use App\Receptions;
use App\DeviceConfiguration;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'location_lat', 'location_long', 'user_id', 'monitor',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    public function device_configurations()
    {
    	return $this->belongsTo(DeviceConfiguration::class);
    }

	public function receptions()
    {
    	return $this->hasMany(Reception::class);
    }
}
