<?php

namespace App;

use App\Pay;
use App\User;
use App\Alert;
use App\Receptions;
use App\AllowedSchedule;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'mdl', 'name', 'description', 'rule_type', 'lat', 'long', 'admin_mon', 'protected', 'on_line', 'on_temp', 'on_hum', 'on_t_set_point', 'on_h_set_point', 'send_mails', 'monitor_expires_at', 'view_alerts_at', 'tmon', 'tdly', 'tcal', 't_set_point', 't_is', 't_change_at', 'tmin', 't_out_at', 'tmax', 'hmon', 'hdly', 'hcal', 'h_set_point', 'h_is', 'h_change_at', 'hmin', 'h_out_at', 'hmax',
    ];

    protected $dates = ['t_out_at', 'h_out_at', 'monitor_expires_at','view_alerts_at', 't_change_at', 'h_change_at'];

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

    public function allowed_schedules()
    {
        return $this->hasMany(AllowedSchedule::class);
    }
}
