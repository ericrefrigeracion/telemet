<?php

namespace App;

use App\Topic;
use App\TypeDevice;
use App\TopicControlType;
use Illuminate\Database\Eloquent\Model;

class TypeDeviceConfiguration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'type_device_id', 'topic_id', 'topic_control_type_id', 'value', 'status', 'status_at'
    ];

     protected $dates = ['status_at'];

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
    public function topic_control_type()
    {
    	return $this->belongsTo(TopicControlType::class);
    }
}
