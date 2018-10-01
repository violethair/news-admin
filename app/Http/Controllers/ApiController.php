<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;

class ApiController extends Controller
{
    public function loadMorePost ($page = 0) {
    	$result = [];
    	$data = Post::where('status', '!=', 'pending')->orderBy('id', 'desc')->skip($page * 50)->take(50)->get()->toArray();

    	foreach($data as $key=>$value) {
    		$result[$key][0] = $value['id'];
    		$category = Category::find($value['cat_id']);
    		$result[$key][1] = !empty($category) ? $category->name : '';
    		$result[$key][2] = $value['name'];
    		$result[$key][3] = $value['publish_at'];
    		$result[$key][4] = $value['status'];
    	}

    	echo json_encode($result);
    }

    public function loadMorePostInCategory ($id, $page = 0) {
        $result = [];
        $data = Post::where('cat_id', $id)->orderBy('id', 'desc')->skip($page * 10)->take(10)->get()->toArray();

        foreach($data as $key=>$value) {
            $result[$key][0] = $value['id'];
            $category = Category::find($value['cat_id']);
            $result[$key][1] = !empty($category) ? $category->name : '';
            $result[$key][2] = $value['name'];
            $result[$key][3] = $value['status'];
        }

        echo json_encode($result);
    }
}
