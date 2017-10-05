<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Question;
use App\Test;
class Category extends Model
{
    public function tags()
    {
    	return $this->hasMany(Tag::class);
    }
   	public function questions($value='')
   	{
   		return $this->hasMany(Question::class);
   	}
   		public function tests ($value='')
   	{
   		return $this->hasMany(Test::class);
   	}
}
