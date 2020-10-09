<?php

namespace App;

use App\Price;
use App\Device;
use App\TypeDeviceConfiguration;
use Illuminate\Database\Eloquent\Model;

class TypeDevice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['prefix', 'model', 'description'];

    protected $dates = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function devices()
    {
    	return $this->HasMany(Device::class);
    }

    public function prices()
    {
    	return $this->HasMany(Price::class);
    }

    public function type_device_configurations()
    {
        return $this->HasMany(TypeDeviceConfiguration::class);
    }
}
