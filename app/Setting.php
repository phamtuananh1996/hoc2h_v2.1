<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Setting extends Model
{
    public function users()
    {
    	return $this->belongToMany(User::class,'account_settings','setting_id','user_id')->withpivot('state');
    }
}
