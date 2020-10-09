<?php

namespace App;

use App\TypeDeviceConfiguration;
use Illuminate\Database\Eloquent\Model;

class TopicControlType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'slug', 'name', 'description', 'operation', 'min', 'max', 'step', 'default'
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
}
