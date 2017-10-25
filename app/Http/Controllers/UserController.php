<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\UserProfile;
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
        $user=User::findorfail($id);
    	$role=Role::all();
        return view('admin.user.edit',compact('role','user'));
    }

    public function adminSettings($id)
    {
    	# code...
    }


    public function adminCreate()
    {
        $role=Role::all();
    	return view('admin.user.create',compact('role'));
    }


    public function adminStore(Request $request)
    {

    	$user=User::create($request->only('user_name','email','password'));
        $user->password=bcrypt($request->password);
        $user->save();
        $user->assignRole($request->role);
        $data=array();
        $data["user_id"]=$user->id;
        if($request->hasFile('avatar')){
          $data["avatar"]=$this->uploadImgur($_FILES['avatar'])['data']['link'];
        }
        else {
            $data["avatar"]="https://imgur.com/a/djlvB";
         }
        $data = array_merge($data, $request->only('name','job','local','phone','birthday','coins','introduction'));
        UserProfile::create($data);
        return redirect('/admin/users');
    }

    public function adminUpdate(Request $request)
    {
    	
    }

    public function adminDestroy(Request $request)
    {
    	User::find($request->id)->delete();
        return 'true';
    }

    public function adminBan(Request $request)
    {
    	$user=User::findorfail($request->id);
        $user->state=0;
        $user->save();
        $user->getRoleNames();
        $user->profile;
        return response()->json($user);
    }
    public function adminMultiBan(Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $user=User::find($value);
            $user->state=0;
            $user->save();
        }
        return 'true';
    }
    public function adminMultiActive(Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $user=User::find($value);
            $user->state=1;
            $user->save();
        }
        return 'true';
    }
    public function adminMultiDelete(Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $user=User::find($value);
            $user->delete();
        }
        return 'true';
    }
    public function adminActive(Request $request)
    {
        $user=User::findorfail($request->id);
        $user->state=1;
        $user->save();
        $user->getRoleNames();
        $user->profile;
        return response()->json($user);
    }

    public function adminGetAll()
    {
        $users=User::with("profile")->get();
        foreach ($users as $user) {
            $user->getRoleNames();
        }
        return response()->json($users);
    }
    public function checkEmail(Request $req)
    {
        if(User::where('email',$req->email)->get()->count())
            {
                return 'false';
            }
        else
            {
                return 'true';
            }
    }
    public function checkUsername(Request $req)
    {
       if(User::where('user_name',$req->user_name)->get()->count())
            {
                return 'false';
            }
        else
            {
                return 'true';
            }
    }
     public function uploadImgur($img) {
      $filename = $img['tmp_name'];
      $client_id="5f83e114af0de78";
      $handle = fopen($filename, "r");
      $data = fread($handle, filesize($filename));
      $pvars   = array('image' => base64_encode($data));
      $timeout = 30;
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
      curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
      $out = curl_exec($curl);
      curl_close ($curl);
      $pms = json_decode($out,true);
      return $pms;
  }
}
