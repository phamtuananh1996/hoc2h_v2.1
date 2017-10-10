<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\QAnswer;
use App\QAnswerVote;
use App\QAnswerComment;
use App\QAnswerCommentVote;

class AnswerController extends Controller
{
    public function index($question_id)
    {
    	
    }

    public function store(Request $request)
    {
    	$this->validate($request,['question_id' =>'required','body' => 'required|min:100']);
      if (Auth::check()) {
        $answer = QAnswer::create([
          'question_id' => $request->question_id,
          'user_id' => Auth::user()->id,
          'body' => $request->body
        ]);

        return $answer;
      } else 
        return -1;
    }

    public function update(Request $request)
    {
    	$this->validate($request,['id' =>'required','body' => 'required|min:50']);

      $answer = QAnswer::findOrFail($request->id);
      if ($this->checkPermission($answer->user_id,'edit_answers')) {
        $answer->body = $request->body;
        $answer->save();
        return $answer;
      } else
        return -1; 

    }

    public function destroy(Request $request)
    {
    	$this->validate($request,['id' =>'required']);

      $answer = QAnswer::findOrFail($request->id);
      if ($this->checkPermission($answer->user_id,'delete_answers')) {
        $answer->delete();
        return 1;
      } else
        return -1; 
    }

   	public function vote(Request $request)
   	{
   		$this->validate($request,['id' =>'required','param' => 'required']);
      if(Auth::check()){
        $answer = QAnswer::findOrFail($request->id);
        if ($request->param == 1) {
          QAnswerVote::create(['answer_id' => $request->id, 'user_id' => Auth::user()->id]);
          $answer->votes_count += 1;
        } else {
          $answerVote = QAnswerVote::where('answer_id',$request->id)->where('user_id',Auth::user()->id)->first();
          $answerVote->delete();
          $answer->votes_count -= 1;
         
        }  
        $answer->save();
        return $request->param; 
      } else
        return -1;
   	}

   	public function setBest(Request $request)
   	{
   		$this->validate($request,['id' =>'required','param' => 'required']);

      $answer = QAnswer::findOrFail($request->id);
      if ($this->checkPermission($answer->user_id,'set_best_answer')) {
        $answer->is_best = $request->param;
        return $request->param;
      } else 
        return -1;
   	}


   	//Answer comments

   	public function addComment(Request $request)
   	{
   		$this->validate($request,['answer_id' =>'required','body' => 'required|min:40']);

      if (Auth::check()) {
        $comment = QAnswerComment::create(['answer_id' => $request->answer_id,'user_id' => Auth::user()->id,'body' => $request->body]);
      }
   	}

   	public function updateComment(Request $request)
   	{
   		$this->validate($request,['id' =>'required','body' => 'required|min:40']);
      $comment = QAnswerComment::findOrFail($request->id);
      if ($this->checkPermission($comment->user_id,'edit_answer_comments')) {
        $comment->body = $request->body;
        $comment->save();
        return $comment;
      } else
        return -1;
   	}

   	public function deleteComment(Request $request)
   	{
   		$this->validate($request,['id' =>'required']);

      $comment = QAnswerComment::findOrFail($request->id);
      if ($this->checkPermission($comment->user_id,'delete_answer_comments')) {
        $comment->delete();
        return 1;
      } else
        return -1;
   	}

   	public function voteComment(Request $request)
   	{
   		$this->validate($request,['id' =>'required','param' => 'required']);
      if(Auth::check()){
        $comment = QAnswerComment::findOrFail($request->id);
        if ($request->param == 1) {
          QAnswerVote::create(['comment_id' => $request->id, 'user_id' => Auth::user()->id]);
          $comment->votes_count += 1;
        } else {
          $commentVote = QAnswerComment::where('comment_id',$request->id)->where('user_id',Auth::user()->id)->first();
          $commentrVote->delete();
          $comment->votes_count -= 1;
         
        }  
        $comment->save();
        return $request->param; 
      } else
        return -1;
   	}

    public function checkPermission($user_id,$permission){

      switch ($permission) {

        case 'edit_answers':
        case 'delete_answers':
        case 'set_best_answer':
          if (Auth::user()->id == $user_id || Auth::user()->can($permission)) {
            return true;
          } else 
            return false;
          break;
      }
   }
}
