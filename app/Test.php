<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TestComment';
use App\User;
use App\TestQuestion;
class Test extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function userRates()
    {
    	return $this->belongsToMany(User::class,'test_rates','test_id','user_id')->withpivot('rate');
    }
     public function comments()
    {
    	return $this->hasMany(TestComment::class);
    }
    public function questions()
    {
    	return $this->hasMany(TestQuestion::class);
    }
     public function userTests()
    {
    	return $this->belongsToMany(User::class,'user_tests','test_id','user_id')->withpivot('point','evaluation_result');
    }
}
