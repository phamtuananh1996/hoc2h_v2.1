<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TestQuestionAnswer;
use App\Test;
class TestQuestion extends Model
{
    public function test()
    {
    	return $this->belongsTo(Test::class);
    }
    public function answers()
    {
    	return $this->hasMany(TestQuestionAnswer::class);
    }
}
