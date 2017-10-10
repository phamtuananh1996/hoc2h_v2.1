<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QAnswerVote extends Model
{
    public function answer()
    {
    	return $this->belongsTo(App\QAnswer::class);
    }
}
