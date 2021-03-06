<?php

namespace App;

use App\User;
use App\Price;
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
        'price_id',
        'payment_id',
        'payment_type',
        'status',
        'detail',
        'operation_type',
        'verified_by_system',
        'period_start',
        'period_finish'
    ];

    protected $dates = ['verified_by_system', 'period_start', 'period_finish'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function device()
    {
    	return $this->belongsTo(Device::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
