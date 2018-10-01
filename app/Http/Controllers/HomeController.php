<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {

    	$user = Session::get('user');

    	if($user->password == null) return redirect('/changePassword');

    	return view('index');
    }
}
