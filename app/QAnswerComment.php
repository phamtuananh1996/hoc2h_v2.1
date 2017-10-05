<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\QAnswer;
use App\QAnswerCommentVote;
use App\User;
class QAnswerComment extends Model
{
    public function questionAnswer()
    {
    	return $this->belongsTo(QAnswer::class);
    }
     public function questionAnswerCommentVotes()
    {
    	return $this->hasMany(QAnswerCommentVote::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function userVotes()
    {
    	return $this->belongsToMany(User::class,'q_answer_comment_votes','comment_id','user_id');
    }
}
