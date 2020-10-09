<?php

namespace App;

use App\Icon;
use App\Device;
use Illuminate\Database\Eloquent\Model;

class Protection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'icon_id', 'type', 'description', ];

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
    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }
}
