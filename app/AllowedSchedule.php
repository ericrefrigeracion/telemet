<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class AllowedSchedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

     protected $dates = ['alert_created_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function devices()
    {
    	return $this->belongsTo(Device::class);
    }
}
