<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeAdminController extends Controller
{
    public function index()
    {
    	return view('admin.home.index');
    }
}
