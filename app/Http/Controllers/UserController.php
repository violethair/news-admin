<?php

namespace App\Http\Controllers;

use Validator;
use Hash;
use Session;
use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Permission;

class UserController extends Controller
{
    public function changeGroup (Request $req) {
        $validator = Validator::make($req->all(), [
            'id' => 'required|exists:accounts',
        ]);

        if ($validator->fails()) {
            Session::flash('error',$validator->errors()->first());
            return redirect()->back();
        }

        $user = Session::get('user');
        $data = User::find($req->id);

        if($data->group_id == 2 && $data->id != $user->id) {
            Session::flash('error','You do not have permission to change group');
            return redirect()->back();
        }

        $data->group_id = $req->group_id;
        $data->save();

        Session::flash('success','Change group successfully');
        return redirect()->back();
    }

    public function editChangePassword (Request $req) {
        $validator = Validator::make($req->all(), [
            'id' => 'required|exists:accounts',
            'new_password' => 'required',
            'retype_new_password' => 'required|same:new_password'
        ]);

        if ($validator->fails()) {
            Session::flash('error',$validator->errors()->first());
            return redirect()->back();
        }

        $user = Session::get('user');
        $data = User::find($req->id);

        if($data->group_id == 2 && $data->id != $user->id) {
            Session::flash('error','You do not have permission to change password');
            return redirect()->back();
        }

        $data->password = Hash::make($req->retype_new_password);
        $data->save();

        Session::flash('success','Change password successfully');

        if($req->id == $user->id) {
            Session::forget("user");
            return redirect('/login');
        } else {
            return redirect()->back();
        }
    }

    public function delete ($user_id) {
        $session = Session::get('user');
        $user = User::find($user_id);

        if($user->group_id == 2 || $user->id == $session->id) {
            Session::flash('error','You do not have permission to delete');
            return redirect()->back();
        }

        $user->delete();

        Session::flash('success','Deleted user');
        return redirect()->back();
    }

    public function index () {

        $data = User::all()->toArray();

        foreach($data as $key=>$value) {
            $group = Group::find($value['group_id']);
            $data[$key]['group'] = !empty($group) ? $group->name : 'Super Admin';
        }

        $data['user'] = $data;
        $data['group'] = Group::all()->toArray();

        foreach($data['group'] as $key=>$value) {
            $arr = explode(";", trim($value['permision'], ";"));
            foreach($arr as $key1=>$value1) {
                $data['group'][$key]['permission'][$key1] = Permission::find($value1)->name;
            }
        }

        return view('user')->with('data', $data);
    }

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
