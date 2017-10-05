<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\Question;
use App\Category;
use App\QAnswer;

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
    	if ($this->checkPermission($question->user_id,'update_question')) {
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

   public function checkPermission($user_id,$permission){
   		switch ($permission) {
   			case 'update_question':
   				if (Auth::user()->id == $user_id || Auth::user()->can('update_question')) {
   					return true;
   				}else
   					return false;
   				break;
   			
   			case 'delete_question':
   				if (Auth::user()->id == $user_id || Auth::user()->can('delete_question')) {
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
