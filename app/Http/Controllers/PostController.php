<?php

namespace App\Http\Controllers;

use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\User;

class PostController extends Controller
{
    public function index () {

        $user = Session::get('user');

        $data['category'] = Category::select(['id','name'])->orderBy('name')->get()->toArray();
        $data['categoryJson'] = json_encode($data['category']);
        if($user->group_id == 1)
        $data['user'] = User::select(['id','name'])->where('id',$user->id)->orderBy('name')->get()->toArray();
        else
        $data['user'] = User::select(['id','name'])->orderBy('name')->get()->toArray();
        $data['userJson'] = json_encode($data['user']);

    	return view('post')->with('data',$data);
    }

    public function add () {
    	$data['category'] = Category::select(['id','name'])->orderBy('name')->get()->toArray();
    	return view('addPost')->with('data', $data);
    }

    public function postAdd (Request $req) {

    	$validator = Validator::make($req->all(), [
        	'title' => 'required',
        	'content' => 'required',
        	'shortdes' => 'required',
        	'cat_id' => 'required',
        	'tags' => 'required',
            'avatar' => 'required'
	    ]);

	    if ($validator->fails()) {
	    	Session::flash('error',$validator->errors()->first());
	    	return redirect()->back()->withInput($req->input());
        }

        $cat_after = "";
        if(!empty($req->sub_cat_id)) {
            foreach($req->sub_cat_id as $key=>$value) {
                $cat_after .= "|" . $value;
            }
        }
        $cat_after .= "|";

        $relate_id = "";
        if(!empty($req->related_id)) {
            foreach ($req->related_id as $key => $value) {
                $relate_id .= $value . ",";
            }
            $relate_id = rtrim($relate_id, ",");
        }
        
        $post = new Post;
        $post->name = $req->title;
        $post->cat_id = $req->cat_id;
        $post->cat_after = $cat_after;
        $post->content = $req->content;
        $post->shortdes = $req->shortdes;
        $post->meta_des = $req->shortdes;
        $post->tag = $req->tags;
        $post->meta_key = $req->tags;
        $post->images = $req->avatar;
        $post->link = $this->toAscii($req->title);
        $post->user_id = Session::get('user')->id;
        $post->user_id_edit = Session::get('user')->id;
        $post->link_thamkhao = $req->reference_link;
        $post->status = 'pending';
        $post->relate_id = $relate_id;
        if(!empty($req->publish_schedule)) $post->publish_schedule = $req->publish_schedule;
        $post->save();

        Session::flash('success', 'Post successfully');
        return redirect('/posts');
    }

    public function edit ($id) {

    	$data = Post::find($id);

    	if(empty($data)) {
    		Session::flash('error','Not found');
	    	return redirect()->back();
    	}

        $user = Session::get('user');

        if($user->group_id == 1) {
            if($user->id != $data->user_id) {
                Session::flash('error', 'You do not have permission to edit');
                return redirect()->back();
            }
        }
        $data = $data->toArray();
        $data['cat_after'] = explode('|', trim($data['cat_after'], '|'));
        $data['relate_id'] = explode(',', $data['relate_id']);

        foreach($data['relate_id'] as $key=>$value) {
            $data['relate_id'][$key] = [];
            $data['relate_id'][$key]['id'] = $value;
            $data['relate_id'][$key]['name'] = Post::find($value)->name;
        }

    	$data['content'] = preg_replace('/(https:\/\/img.iholding.io)\/(.*)fill\!(.*)/', env('API_URL') . '/postThumb/${3}', $data['content']);
		$data['content'] = preg_replace('/(http:\/\/img.iholding.io)\/(.*)fill\!(.*)/', env('API_URL') . '/postThumb/${3}', $data['content']);

    	$data['category'] = Category::select(['id','name'])->get()->toArray();

    	return view('editPost')->with('data', $data);
    }

    public function postEdit (Request $req) {
    	$validator = Validator::make($req->all(), [
    		'id' => 'required|exists:posts',
        	'title' => 'required',
        	'content' => 'required',
        	'shortdes' => 'required',
        	'cat_id' => 'required',
        	'tags' => 'required'
	    ]);

	    if ($validator->fails()) {
	    	Session::flash('error',$validator->errors()->first());
	    	return redirect()->back()->withInput($req->input());
        }

        $cat_after = "";
        if(!empty($req->sub_cat_id)) {
            foreach($req->sub_cat_id as $key=>$value) {
                $cat_after .= "|" . $value;
            }
        }
        $cat_after .= "|";

        $relate_id = "";
        if(!empty($req->related_id)) {
            foreach ($req->related_id as $key => $value) {
                $relate_id .= $value . ",";
            }
            $relate_id = rtrim($relate_id, ",");
        }

        $post = Post::find($req->id);
        if($req->tags != $post->tag) $post->relate_id = $this->findRelate($req->tags);
        $post->name = $req->title;
        $post->cat_id = $req->cat_id;
        $post->cat_after = $cat_after;
        $post->content = $req->content;
        $post->shortdes = $req->shortdes;
        $post->meta_des = $req->shortdes;
        $post->tag = $req->tags;
        $post->meta_key = $req->tags;
        $post->link = $this->toAscii($req->title);
        $post->link_thamkhao = $req->reference_link;
        $post->user_id_edit = Session::get('user')->id;
        $post->relate_id = $relate_id;
        if(!empty($req->publish_schedule)) $post->publish_schedule = $req->publish_schedule;
        
        if ($req->hasFile('avatar')) {
            $file = $req->avatar;
            $date = date('d-m-Y');
	        $path = base_path() . env('UPLOAD_AVATAR_PATH') . '/' . $date;
	        if (!file_exists($path)) {
			    mkdir($path, 0777, true);
			}
			$avatarFileName = str_random(64) . '.' . $file->getClientOriginalExtension();
	        $file->move($path, $avatarFileName);
	        $post->images = 'iholding.io/' . $date . '/' . $avatarFileName;
        }

        $post->save();

        Session::flash('success', 'Saved');
        return redirect()->back();
    }

    public function pending ($id) {
    	$post = Post::find($id);
    	if(empty($post)) {
    		Session::flash('error','Not found');
	    	return redirect()->back();
    	}

    	$post->status = 'pending';
    	$post->publish_at = null;
    	$post->save();

    	Session::flash('success','Pending');
    	return redirect()->back();
    }

    public function publish ($id) {
    	$post = Post::find($id);
    	if(empty($post)) {
    		Session::flash('error','Not found');
	    	return redirect()->back();
    	}

    	$post->status = 'publish';
    	$post->publish_at = date('Y-m-d H:i:s');
    	$post->save();

    	Session::flash('success','Published');
    	return redirect()->back();
    }

    public function delete ($id) {
    	$post = Post::find($id);
    	if(empty($post)) {
    		Session::flash('error','Not found');
	    	return redirect()->back();
    	}

    	if($post->status == 'delete') {
    		$post->status = 'publish';
    		$post->publish_at = date('Y-m-d H:i:s');
    		$post->save();
    		Session::flash('success','Undeleted');
    	} else {
    		$post->status = 'delete';
    		$post->save();
    		Session::flash('success','Deleted');
    	}

    	
    	return redirect()->back();
    }

    public function search ($query) {
    	$result = [];
    	$data = Post::where('name', 'LIKE', '%'.$query.'%')->orderBy('id', 'desc')->limit(10)->get()->toArray();

    	foreach($data as $key=>$value) {
    		$category = Category::find($value['cat_id'])->name;
    		$result[$key]['id'] = $value['id'];
    		$result[$key]['status'] = $value['status'];
    		$result[$key]['name'] = $value['name'];
    		$result[$key]['category'] = $category;
    	}

    	echo json_encode($result);
    }

    public function findRelate ($tags) {
    	$result = '';
    	$arr = explode(',', $tags);
    	$count = 0;
    	foreach($arr as $key=>$value) {
    		$data = Post::where('tag', 'LIKE', '%'.$value.'%')->orderBy('id', 'desc')->get()->toArray();
    		foreach($data as $key=>$value) {
    			if($count == 10) {
    				$result .= $value['id'];
    				return trim($result, ',');
    			} else {
    				$result .= $value['id'] . ',';
    				$count++;
    			}
    		}
    	}

    	return trim($result, ',');
    }

	public function toAscii($str, $replace=array(), $delimiter='-') {
	 	if( !empty($replace) ) {
	  		$str = str_replace((array)$replace, ' ', $str);
	 	}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	 	return $clean;
	}
}
