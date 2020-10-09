<?php

namespace App;

use App\Icon;
use App\Device;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon_id',
        'name',
        'description',
        'scripts',
    ];

    protected $dates = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function device()
    {
    	return $this->hasMany(Device::class);
    }

    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }
}
