<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function index()
    {
    	# code...
    }

    public function show($id)
    {
    	# code.
    }

    public function settings($id)
    {
    	# code...
    }

    public function actives($id)
    {
    	# code...
    }

    public function updateProfile(Request $request)
    {
    	# code...
    }

    public function updateSettings(Request $request)
    {
    	# code...
    }

    public function checkPermission($user_id, $permission)
    {
    	# code...
    }

    public function setDateFomat($object)
    {
    	# code...
    }

    //ADMIN CONTROLLER

    public function adminIndex()
    {
    	return view('admin.user.index');
    }

    public function adminShow($id)
    {
    	# code...
    }

    public function adminSettings($id)
    {
    	# code...
    }


    public function adminCreate()
    {
    	# code...
    }


    public function adminStore(Request $request)
    {
    	# code...
    }

    public function adminUpdate(Request $request)
    {
    	# code...
    }

    public function adminDestroy(Request $request)
    {
    	# code...
    }

    public function adminBan(Request $request)
    {
    	# code...
    }

    public function adminGetAll()
    {
        $users=User::with("profile")->get();
        foreach ($users as $user) {
            $user->getRoleNames();
        }
        return response()->json($users);
    }

}
