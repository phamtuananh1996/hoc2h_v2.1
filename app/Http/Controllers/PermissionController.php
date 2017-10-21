<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
class PermissionController extends Controller
{
    public function index()
    {
    	return view('admin.permission.index');
    }

    public function show($id)
    {
    	# code...
    }

    public function store(Request $request)
    {
    	$permission=new Permission;
        $permission->name=$request->name;
        $permission->guard_name="web";
        $permission->save();
        return response()->json($permission);
    }

    public function update(Request $request)
    {
    	$permission=Permission::find($request->id);
        $permission->name=$request->name;
        $permission->save();
        return response()->json($permission);
    }

    public function destroy(Request $request)
    {
        $permission=Permission::find($request->id);
        $permission->delete();
    	return response()->json($permission);
    }
    public function adminGetAll()
    {
        return response()->json(Permission::all());
    }
    public function multiDelete(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            Permission::find($value)->delete();
        }
        return 'true';
    }
    public function search(Request $req)
    {
       $permissions=Permission::where('name', 'like', '%' . $req->name . '%')->get();
       return response()->json($permissions);
    }
}
