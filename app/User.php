<?php

namespace App;

use App\Pay;
use App\Device;
use App\MailAlert;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'phone_area_code', 'phone_number', 'address', 'dni','notification_email_1', 'notification_email_2', 'notification_email_3', 'notification_phone_number_1', 'notification_phone_number_2', 'notification_phone_number_3',
    ];

     protected $dates = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function pays()
    {
        return $this->hasMany(Pay::class);
    }

}
