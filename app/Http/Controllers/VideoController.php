<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Illuminate\Http\Request;
use App\Video;

class VideoController extends Controller
{
    public function index () {
    	return view('video');
    }

    public function add (Request $req) {

    	$validator = Validator::make($req->all(), [
            'title' => 'required',
            'src_video' => 'required|url|unique:videos',
        ]);

        if ($validator->fails()) {
            Session::flash('error',$validator->errors()->first());
            return redirect()->back();
        }

    	$data = new Video;
    	$data->name = $req->title;
    	$data->src_video = $req->src_video;
    	$data->created = date('Y-m-d H:i:s');
    	$data->save();

    	Session::flash('success','Add new video successfully');
        return redirect()->back();
    }

    public function edit (Request $req) {
    	$validator = Validator::make($req->all(), [
    		'id'=> 'required|exists:videos',
            'title' => 'required',
            'src_video' => 'required|url',
        ]);

        if ($validator->fails()) {
            Session::flash('error',$validator->errors()->first());
            return redirect()->back();
        }

        $data = Video::find($req->id);
        $data->name = $req->title;
        $data->src_video = $req->src_video;
        $data->save();

        Session::flash('success','Saved');
        return redirect()->back();
    }

    public function delete ($id) {
    	$data = Video::find($id);

    	if(empty($data)) {
    		Session::flash('error','Not found');
        	return redirect()->back();
    	}

    	$data->delete();

    	Session::flash('success','Deleted');
        return redirect()->back();
    }
}
