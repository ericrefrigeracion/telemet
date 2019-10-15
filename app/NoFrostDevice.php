<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class NoFrostDevice extends Model
{
	protected $fillable = [
        'id',
        'device_id',
    ];

    protected $dates = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function device()
    {
    	return $this->belongsTo(Device::class);
    }
}
