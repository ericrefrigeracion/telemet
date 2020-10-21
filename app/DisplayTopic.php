<?php

namespace App;

use App\Topic;
use App\Display;
use Illuminate\Database\Eloquent\Model;

class DisplayTopic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'display_id', 'topic_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function topic()
    {
    	return $this->belongsTo(Topic::class);
    }
    public function display()
    {
    	return $this->belongsTo(Display::class);
    }
}
