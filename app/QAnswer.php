<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\QAnswerComments;
use App\User;
class QAnswer extends Model
{
    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
     public function Comments()
    {
    	return $this->hasMany(QAnswerComments::class);
    }
    public function userVotes()
    {
    	return $this->belongsToMany(User::class,'q_answer_votes','answer_id','user_id');
    }
}
