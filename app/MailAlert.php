<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class MailAlert extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'last_data01', 'last_created_at', 'user_id', 'device_id', 'send', 'type'
    ];

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
