<?php

namespace App;

use App\Pay;
use App\User;
use App\Alert;
use App\Receptions;
use App\DeviceConfiguration;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'lat', 'long', 'user_id', 'send_mails', 'admin_mon', 'on_line', 'tmon', 'tmin', 'tmax', 'tdly', 'tcal', 'twatch', 'hmon', 'hmin', 'hmax', 'hdly', 'hcal', 'hwatch',
    ];

    protected $dates = ['hwatch', 'twatch'];

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
        return $this->hasMany(Alert::class);
    }
    public function pays()
    {
        return $this->hasMany(Pay::class);
    }
}
