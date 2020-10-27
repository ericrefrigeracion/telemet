<?php

namespace App;

use App\ViewConfiguration;
use App\DeviceConfiguration;
use App\TypeDeviceConfiguration;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'slug', 'unit', 'name', 'decimals', 'color', 'filled'
    ];

     protected $dates = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function type_device_configurations()
    {
        return $this->hasMany(TypeDeviceConfiguration::class);
    }
    public function view_configurations()
    {
        return $this->hasMany(ViewConfiguration::class);
    }
    public function device_configurations()
    {
        return $this->hasMany(DeviceConfiguration::class);
    }
}
