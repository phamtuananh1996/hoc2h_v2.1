<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Test;
class TestComment extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function test()
    {
    	return $this->belongsTo(Test::class);
    }
    public function userTests()
    {
    	return $this->belongsToMany(User::class,'test_comment_votes','comment_id','user_id');
    }
}
