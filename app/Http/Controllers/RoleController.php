<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
class RoleController extends Controller
{
    public function index()
    {
    	return view('admin.role.index');
    }

    public function show($id)
    {
    	# code...
    }

    public function create(Request $req)
    {
    	
    }


    public function store(Request $request)
    {
    	$role=new Role;
        $role->name=$request->name;
        $role->guard_name="web";
        $role->save();
        return response()->json($role);
    }


    public function update(Request $request)
    {
    	if($this->checkRole($request->id))
        {
            $role=Role::find($request->id);
            $role->name=$request->name;
            $role->save();
            return response()->json($role);
        }
        else
        {
            return "false";
        }
    }

    public function destroy($id)
    {
        if($this->checkRole($id))
        {
    	   $Role = Role::find($id);
           $users = User::role($Role->name)->get();
           $Role->delete();
           return response()->json($Role);
        }
        else
        {
            return false;
        }
    }
    public function adminGetAll()
    {
       return response()->json(Role::all());
    }
    public function multiDelete(Request $req)
    {
        if($this->checkMutiDeleteRole($req->all()))
        {
            foreach ($req->all() as $key => $value) {
                Role::find($value)->delete();
            }
            return 'true';
        }
        else
        {
            return 'false';
        }
    }
    public function checkRole($id)
    {
        if($id==1||$id==2||$id==3||$id==4||$id==5)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function checkMutiDeleteRole($array=array())
    {
        foreach ($array as $key => $value) {
            if($value==1||$value==2||$value==3||$value==4||$value==5)
            {
                return false;
            }
        }
        return true;
    }
}
