<?php

namespace App;

use App\Device;
use App\Price;
use Illuminate\Database\Eloquent\Model;

class TypeDevice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['prefix', 'model', 'description', 'data01_unit', 'data01_name', 'data02_unit', 'data02_name', 'data03_unit', 'data03_name', 'data04_unit', 'data04_name', 'data05_unit', 'data05_name', 'data06_unit', 'data06_name', 'data07_unit', 'data07_name', 'data08_unit', 'data08_name', 'data09_unit', 'data09_name', 'data10_unit', 'data10_name', 'data11_unit', 'data11_name', 'data12_unit', 'data12_name'];

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
    	return $this->HasMany(Device::class);
    }

    public function prices()
    {
    	return $this->HasMany(Price::class);
    }
}
