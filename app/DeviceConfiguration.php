<?php

namespace App;

use App\Topic;
use App\Device;
use App\TopicControlType;
use Illuminate\Database\Eloquent\Model;

class DeviceConfiguration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'device_id', 'topic_id', 'topic_control_type_id', 'value', 'status', 'status_at'
    ];

     protected $dates = ['status_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function device()
    {
    	return $this->belongsTo(Device::class);
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
