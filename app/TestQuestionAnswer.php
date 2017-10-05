<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App/TestQuestion;
class TestQuestionAnswer extends Model
{
     public function question()
    {
    	return $this->belongsTo(TestQuestion::class);
    }
}
