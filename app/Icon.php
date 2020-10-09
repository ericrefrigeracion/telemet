<?php

namespace App;

use App\Device;
use App\Status;
use App\TypeDevice;
use App\Protection;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'scripts', 'type'
    ];

     protected $dates = [
     	//
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	//
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function type_devices()
    {
        return $this->hasMany(TypeDevice::class);
    }

    public function protections()
    {
        return $this->hasMany(Protection::class);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
}
