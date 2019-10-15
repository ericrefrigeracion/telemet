<?php

namespace App;

use App\Pay;
use App\Rule;
use App\User;
use App\Alert;
use App\Protection;
use App\Receptions;
use App\TypeDevice;
use App\TinyTDevice;
use App\NoFrostDevice;
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
        'id',
        'user_id',
        'type_device_id',
        'protection_id',
        'name',
        'description',
        'lat',
        'lon',
        'admin_mon',
        'protected',
        'on_line',
        'monitor_expires_at',
        'view_alerts_at',
        'notification_email',
        'notification_phone_area_code',
        'notification_phone_number',
    ];

    protected $dates = ['monitor_expires_at','view_alerts_at',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function type_device()
    {
        return $this->belongsTo(TypeDevice::class);
    }

    public function tiny_t_device()
    {
        return $this->hasOne(TinyTDevice::class);
    }

    public function no_frost_device()
    {
        return $this->hasOne(NoFrostDevice::class);
    }

    public function protection()
    {
        return $this->belongsTo(Protection::class);
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

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }
}
