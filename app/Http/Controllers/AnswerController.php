<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index($question_id)
    {
    	# code...
    }

    public function store(Request $request)
    {
    	# code...
    }

    public function update(Request $request)
    {
    	# code...
    }

    public function destroy(Request $request)
    {
    	# code...
    }

   	public function vote(Request $request)
   	{
   		# code...
   	}

   	public function setBest(Request $request)
   	{
   		# code...
   	}


   	//Answer comments

   	public function addComment(Request $request)
   	{
   		# code...
   	}

   	public function updateComment(Request $request)
   	{
   		# code...
   	}

   	public function deleteComment(Request $request)
   	{
   		# code...
   	}

   	public function voteComment(Request $request)
   	{
   		# code...
   	}
}
