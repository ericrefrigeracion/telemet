<?php

namespace App;

use App\Icon;
use App\Price;
use App\Device;
use App\ViewConfiguration;
use App\TypeDeviceConfiguration;
use Illuminate\Database\Eloquent\Model;

class TypeDevice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['icon_id', 'prefix', 'model', 'description'];

    protected $dates = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }

    public function devices()
    {
    	return $this->hasMany(Device::class);
    }

    public function prices()
    {
    	return $this->hasMany(Price::class);
    }

    public function type_device_configurations()
    {
        return $this->hasMany(TypeDeviceConfiguration::class);
    }
    public function view_configurations()
    {
        return $this->hasMany(ViewConfiguration::class);
    }
}
