<?php

namespace App;

use App\User;
use App\Device;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id', 'user_id', 'webhook_identifier', 'amount', 'status', 'title', 'description', 'external_reference', 'init_point',
        'verified_by_system',
    ];

     protected $dates = ['external_reference'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function devices()
    {
    	return $this->belongsTo(Device::class);
    }
}
