<?php

namespace App;

use App\Data;
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
        'id', 'name', 'user_id',
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

	public function datas()
    {
    	return $this->hasMany(Data::class);
    }
}
