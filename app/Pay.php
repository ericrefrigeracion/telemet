<?php

namespace App;

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
         'device_id', 'user_id', 'type', 'status', 'description', 'method', 'payer', 'amount', 'vigent_until',
    ];

     protected $dates = ['vigent_until'];

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
