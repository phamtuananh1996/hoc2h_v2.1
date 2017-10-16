<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function index()
    {
    	return view('admin.category.index');
    }

    public function show($id)
    {
    	# code...
    }

    public function store(Request $request)
    {
    	$category=new Category;
        $category->name=$request->name;
        $category->descriptions=$request->name;
        $category->parent_id=$request->parent_id;
        $category->order_display=0;
        $category->save();
        return response()->json($category);
    }

    public function update(Request $request)
    {
    	$category=Category::find($request->id);
        $category->name=$request->name;
        $category->descriptions=$request->name;
        $category->parent_id=$request->parent_id;
        $category->order_display=0;
        $category->save();
        return response()->json($category);
    }

    public function destroy(Request $request)
    {
    	$category=Category::find($request->id)->delete();
        return response()->json($category);
    }
    public function listAll()
    {
        $categories=Category::all();
        foreach ($categories as $category) {
            if($category->parent_id==0)
            {
                $category->parent="#";
            }
            else
            {
             $category->parent=$category->parent_id;
            }
             $category->text=$category->name;
        }
        return response()->json($categories);
    }

    
}
