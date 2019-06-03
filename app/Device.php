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
        'id', 'name', 'lat', 'long', 'user_id', 'mon', 'mail', 'min', 'max', 'dly', 'cal',
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

	public function receptions()
    {
    	return $this->hasMany(Reception::class);
    }
    public function alerts()
    {
        return $this->hasMany(Reception::class);
    }
}
