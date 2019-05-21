<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_mail', 'notification_phone', 'payment_date', 'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
}
