<?php

namespace App;

use App\ViewConfiguration;
use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name', 'description', 'slug', 'script', 'title'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function view_configurations()
    {
    	return $this->hasMany(ViewConfiguration::class);
    }
}
