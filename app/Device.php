<?php

namespace App;

use App\Pay;
use App\Rule;
use App\User;
use App\Icon;
use App\Alert;
use App\Status;
use App\DeviceLog;
use App\Protection;
use App\Receptions;
use App\TypeDevice;
use App\MqttLog;
use App\AllowedSchedule;
use App\DeviceConfiguration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;
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
        'status_id',
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

    public function protection()
    {
        return $this->belongsTo(Protection::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function icon()
    {
        return $this->belongsTo(Icon::class);
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
    public function device_logs()
    {
        return $this->hasMany(DeviceLog::class);
    }
    public function device_configurations()
    {
        return $this->hasMany(DeviceConfiguration::class);
    }
    public function mqtt_logs()
    {
        return $this->hasMany(MqttLog::class);
    }
}
