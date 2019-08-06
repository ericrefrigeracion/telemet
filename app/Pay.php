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
        'id',
        'user_id',
        'device_id',
        'preference_id',
        'valid_at',
        'collection_status',
        'init_point',
        'verified_by_sistem',
        'collection_id',
        'merchant_order_id',
        'payment_type',
        'processing_mode',
    ];

    protected $dates = ['valid_at'];

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
