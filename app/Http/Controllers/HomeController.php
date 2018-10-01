<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Setting;
use App\Post;
use App\Category;
use App\Article;
use App\Video;

class HomeController extends Controller
{
    public function index () {

    	$user = Session::get('user');

    	if($user->password == null) return redirect('/changePassword');

        $data['totalPost'] = Post::all()->count();
        $data['totalCategory'] = Category::all()->count();
        $data['totalPressRelease'] = Article::all()->count();
        $data['totalVideo'] = Video::all()->count();

    	return view('index')->with('data', $data);
    }

    public function setting () {
    	$data = Setting::first();
    	return view('setting')->with('data',$data);
    }

    public function postSetting (Request $req) {

    	$data = Setting::first();
    	$data->title = $req->title;
    	$data->email = $req->email;
    	$data->footer = $req->footer;
    	$data->contactinfo = $req->contactinfo;
    	$data->meta_key = $req->meta_key;
    	$data->meta_des = $req->meta_des;
    	$data->facebook = $req->facebook;
    	$data->google = $req->google;
    	$data->tiwter = $req->tiwter;
    	$data->youtube = $req->youtube;
    	$data->reddit = $req->reddit;
    	$data->save();

    	Session::flash('success', 'Saved');
    	return redirect()->back();
    }
}
