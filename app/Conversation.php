<?php

namespace App;
use App\User;
use App\Message;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function messages()
    {
    	return $this->hasMany(Message::class);
    }
}
