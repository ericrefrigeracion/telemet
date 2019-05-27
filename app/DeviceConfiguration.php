<?php

namespace App;

use App\Devices;
use Illuminate\Database\Eloquent\Model;

class DeviceConfiguration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data01_mon', 'data01_min', 'data01_max', 'data01_dly', 'data01_cal', 'data01_typ',
        'data02_mon', 'data02_min', 'data02_max', 'data02_dly', 'data02_cal', 'data02_typ',
        'data03_mon', 'data03_min', 'data03_max', 'data03_dly', 'data03_cal', 'data03_typ',
        'data04_mon', 'data04_min', 'data04_max', 'data04_dly', 'data04_cal', 'data04_typ',
        'data05_mon', 'data05_min', 'data05_max', 'data05_dly', 'data05_cal', 'data05_typ',
        'data06_mon', 'data06_min', 'data06_max', 'data06_dly', 'data06_cal', 'data06_typ',
        'data07_mon', 'data07_min', 'data07_max', 'data07_dly', 'data07_cal', 'data07_typ',
        'data08_mon', 'data08_min', 'data08_max', 'data08_dly', 'data08_cal', 'data08_typ',
        'data09_mon', 'data09_min', 'data09_max', 'data09_dly', 'data09_cal', 'data09_typ',
        'data10_mon', 'data10_min', 'data10_max', 'data10_dly', 'data10_cal', 'data10_typ',
        'data11_mon', 'data11_min', 'data11_max', 'data11_dly', 'data11_cal', 'data11_typ',
        'data12_mon', 'data12_min', 'data12_max', 'data12_dly', 'data12_cal', 'data12_typ',
        'mail_send', 'device_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'device_id',
    ];

    public function devices()
    {
    	return $this->belongsTo(Device::class);
    }
}
