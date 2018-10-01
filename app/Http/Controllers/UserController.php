<?php

namespace App\Http\Controllers;

use Validator;
use Hash;
use Session;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	public function login () {
		if(Session::has('user')) return redirect('/');
		return view('login');
	}

    public function postLogin (Request $req) {

    	$validator = Validator::make($req->all(), [
        	'email' => 'required|email|exists:accounts',
        	'password' => 'required',
	    ]);

	    if ($validator->fails()) {
	    	Session::flash('error',$validator->errors()->first());
	    	return redirect()->back();
        }

    	$data = User::where('email', $req->email)->first();

    	if($data->password == null) {
    		Session::put('user', $data);
    	} else {
    		if(!Hash::check($req->password, $data->password)) {
    			Session::flash('error','Wrong password');
	    		return redirect()->back();
    		} else {
    			Session::put('user', $data);
    		}
    	}
    	
    	Session::flash('success', 'Login successfully');
    	return redirect('/');
    }

    public function changePassword () {

    	$user = Session::get('user');

    	$data['user'] = $user;

    	return view('changePassword')->with('data', $data);
    }

    public function postChangePassword (Request $req) {
    	$validator = Validator::make($req->all(), [
        	'id' => 'required|exists:accounts',
        	'password' => 'required|min:8',
        	'retype-password' => 'required|same:password'
	    ]);

	    if ($validator->fails()) {
	    	Session::flash('error',$validator->errors()->first());
	    	return redirect()->back();
        }

        $data = User::find($req->id);

        if($data->password != null) {
        	Session::flash('error','Your password is changed. Please re-login');
	    	return redirect()->back();
        }

        $data->password = Hash::make($req->password);
        $data->save();

        Session::forget('user');
        Session::flash('success', 'Change password successfully. Please re-login');
        return redirect('/login');
    }

    public function logout () {
    	Session::forget('user');
    	Session::flash('success', 'Logout successfully');
    	return redirect('/');
    }
}
