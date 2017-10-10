<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionVote extends Model
{
	public function question()
	 {
	 	return $this->belongsTo(App\Question::class);
	 } 
}
