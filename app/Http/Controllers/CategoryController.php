<?php

namespace App\Http\Controllers;

use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;

class CategoryController extends Controller
{
    public function index () {

    	$data = Category::whereNull('parent_id')->get()->toArray();

    	foreach($data as $key=>$value) {
    		$data[$key]['numberPost'] = Post::where('cat_id', $value['id'])->count();
    		$data[$key]['child'] = Category::where('parent_id', $value['id'])->get()->toArray();
    		foreach($data[$key]['child'] as $key1=>$value1) {
    			$data[$key]['child'][$key1]['numberPost'] = Post::where('cat_id', $value1['id'])->count();
    		}
    	}

    	return view('category')->with('data', $data);
    }

    public function edit ($id) {
    	$data = Category::find($id);

    	if($data['parent_id'] != null) {
    		$data['allCategory'] = Category::whereNull('parent_id')->get()->toArray();
    	}

    	return view('editCategory')->with('data', $data);
    }

    public function postEdit (Request $req) {
    	$data = Category::find($req->id);

    	if(empty($data)) {
    		Session::flash('error','Not found');
	    	return redirect()->back();
    	}

    	if($data->parent_id != null) $data->parent_id = !empty($req->parent_id) ? $req->parent_id :  $data->parent_id;
    	$data->name = $req->name;
    	$data->meta_des = $req->meta_des;
    	$data->meta_key = $req->meta_key;
    	$data->save();

    	Session::flash('success','Saved');
    	return redirect()->back();
    }

    public function add () {
    	$data = Category::whereNull('parent_id')->get()->toArray();
    	return view('addCategory')->with('data', $data);
    }

    public function postAdd (Request $req) {
    	$validator = Validator::make($req->all(), [
        	'parent_id' => 'required',
        	'name' => 'required',
        	'meta_des' => 'required',
        	'meta_key' => 'required'
	    ]);

	    if ($validator->fails()) {
	    	Session::flash('error',$validator->errors()->first());
	    	return redirect()->back()->withInput($req->input());
        }

        $category = new Category;
        $category->parent_id = $req->parent_id == 0 ? null : $req->parent_id;
        $category->name = $req->name;
        $category->meta_des = $req->meta_des;
        $category->meta_key = $req->meta_key;
        $category->save();

        Session::flash('success','Create new category sunccessfully');
    	return redirect('/category');
    }
}
