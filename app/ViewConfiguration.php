<?php

namespace App;

use App\Topic;
use App\Display;
use App\TypeDevice;
use Illuminate\Database\Eloquent\Model;

class ViewConfiguration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'type_device_id', 'topic_id', 'display_id', 'order'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function type_device()
    {
    	return $this->belongsTo(TypeDevice::class);
    }
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    public function display()
    {
        return $this->belongsTo(Display::class);
    }
}

