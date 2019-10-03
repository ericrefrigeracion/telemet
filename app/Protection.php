<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class Protection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'type', 'description', 'class' ];

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
    	return $this->hasMany(Device::class);
    }
}
