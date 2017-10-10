<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\Question;
use App\Category;
use App\QAnswer;
use App\QuestionVote;
use App\QuestionTag;
use App\QRequestAnswer;

class QuestionController extends Controller
{
    public function index(){
    	//return index view
    }

    public function fillter($fillter){
    	//return list questions with fillter type
    }

    public function show($id) {
    	//show question with question_id = $id
    	$question = Question::findOrFail($id);
      $question->views_count += 1;
      $question->save();
    	return $question;
    }

    public function create() {
    	//return question create form

    }

    public function  store(Request $request){
    	//store new question into database and redirect show
    	$this->validate($request,[
    		'title'=> 'required',
    		'category'=> 'required',
    	]);

    	$new_question = Question::create([
    		'title' => $request->title,
    		'category_id' =>$request->category,
    		'user_id' => Auth::user()->id,
    		'body' => $request->body,
    	]);

    	if (isset($request->tags)) {
    		foreach ($request->tags as $key => $tag) {
    			QuestionTag::create([
    				'question_id' => $new_question->id,
    				'tag_id' => $tag,
    			]);
    		}
    	}

    	return $new_question;
    }

    public function update(Request $request){

    	$this->validate($request,[
    		'title'=> 'required',
    		'category'=> 'required',
    	]);

    	$question = Question::find($request->id);
    	if ($this->checkPermission($question->user_id,'edit_question')) {
 			$question->category_id = $request->category;
	    	$question->title = $request->title;
	    	$question->body = $request->body;
	    	$question->save();

	    	return $question;
 		}else {
 			return -1;
 		}
    
    }

    public function destroy(Request $request){
    	$question = Question::findOrFail($request->id);
    	if($this->checkPermission($questions->user_id,'delete_question')){
    		$question->delete();
    	}
    }


    public function vote(Request $request){

      $this->validate($request,['id' => 'required','param' => 'required']);

      if (Auth::check()) {
        $question = Question::findOrFail($request->id);
        if ($request->param == 1) {
          QuestionVote::create('question_id',$request->id,'user_id',Auth::user()->id);
          $question->votes_count += 1;
         
        }else {
          $question_vote = QuestionVote::where('question_id',$request->id)->where('user_id',Auth::user()->id)->first();
          $question_vote->delete();
          $question->votes_count -= 1;
        }
        $question->save();
        return $request->param;
      } else return -1;
    }

    public function resolve(Request $request) {

      $this->validate($request,['id' => 'required','param' => 'required']);
      $question = Question::findOrFail($request->id);

      if ($this->checkPermission($question->user_id,'set_rosolved')) {
        $question->is_resolved = $request->param;
        return $question;
      }else 
        return -1;

    }

    public function requestAnswer(Request $request){

      if (Auth::check()) {
             
      }

    }

    
    public function checkPermission($user_id,$permission){

   		switch ($permission) {

   			case 'edit_question':
        case 'delete_question':
        case 'set_rosolved':
   				if (Auth::user()->id == $user_id || Auth::user()->can($permission)) {
   					return true;
   				}else
   					return false;
   				break;
   		}
   }

    //set date-time format 
    public function setDateFomat($object){
       if($object->created_at->diffInDays(Carbon::now()) > 1){
            $object->date_created = $object->created_at->format('d/m/Y');    
        } else {
            $object->date_created = $object->created_at->diffForHumans();
        } 
    }

}
