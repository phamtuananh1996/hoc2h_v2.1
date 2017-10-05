<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class NotificationSetting extends Model
{
	public function users()
	{
		  return $this->belongsToMany(User::class,'user_notifications','notification_id','user_id')->withpivot('state');
	}
}
