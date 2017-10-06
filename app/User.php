<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Setting;
use App\NotificationSetting;
use App\UserProfile;
use App\Question;
use App\Test;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function settings()
    {
       return $this->belongsToMany(Setting::class,'account_settings','user_id','setting_id');
    }
     public function notificationa()
    {
       return $this->belongsToMany(NotificationSetting::class,'account_settings','user_id','notification_id')->withpivot('state');
    }
    public function profiles()
    {
       return $this->hasOne(UserProfile::class);
    }
     public function questions()
    {
       return $this->hasMany(Question::class);
    }
    public function tests()
    {
       return $this->hasMany(Test::class);
    }
}
