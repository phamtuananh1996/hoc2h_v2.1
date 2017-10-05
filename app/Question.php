<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Category;
use App\Tag;
use App\QAnswer;
class Question extends Model
{
    public function user()
    {
    	return $this->belongTo(User::class);
    }
    public function category()
    {
    	return $this->belongTo(Category::class);
    }
    public function tags()
    {
    	return $this->belongToMany(Tag::class,'question_tags','question_id','tag_id');
    }
    public function userVotes()
    {
    	return $this->belongToMany(User::class,'question_votes','question_id','user_id');
    }
    public function userFollowers()
    {
    	return $this->belongToMany(User::class,'question_followers','question_id','user_id');
    }
     public function userRequestAnswers()
    {
    	return $this->belongToMany(User::class,'q_request_answers','question_id','user_id')->withpivot('requester_id','donate_coins','is_comfirmed','reject_reason');
    }
    public function answers()
    {
    	return $this->hasMany(QAnswer::class);
    }
}
