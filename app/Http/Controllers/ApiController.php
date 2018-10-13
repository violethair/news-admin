<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\User;
use App\Video;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function loadMorePost (Request $req) {

        $query = $req->all();
        $length = $query['length'];
        $page = ($query['start'] / $length) - 1;

        $user = Session::get('user');
        $result = [];

        $search = [];
        $countSearch = 0;
        foreach($query['columns'] as $key=>$value) {
            if(!empty($value['search']['value'])) {
                $search[$countSearch]['col'] = $value['name'];
                $search[$countSearch]['value'] = $value['search']['value'];
                $countSearch++;
            }
        }

        if($user->group_id == 1) {
            $data = Post::where('user_id', $user->id);
            if(!empty($search)) {
                foreach ($search as $key => $value) {
                    if($value['col'] == 'name')
                    $data = $data->where($value['col'], 'LIKE', '%'.$value['value'].'%');
                    else
                    $data = $data->where($value['col'], $value['value']);
                }
            }
            $recordsFiltered = $data->orderBy($query['columns'][$query['order'][0]['column']]['name'], $query['order'][0]['dir'])->count();
            $data = $data->orderBy($query['columns'][$query['order'][0]['column']]['name'], $query['order'][0]['dir'])->skip($page * $length)->take($length)->get()->toArray();
        } else {
            $data = Post::select("*");
            if(!empty($search)) {
                foreach ($search as $key => $value) {
                    if($value['col'] == 'name')
                    $data = $data->where($value['col'], 'LIKE', '%'.$value['value'].'%');
                    else
                    $data = $data->where($value['col'], $value['value']);
                }
            }
            $recordsFiltered = $data->orderBy($query['columns'][$query['order'][0]['column']]['name'], $query['order'][0]['dir'])->count();
            $data = $data->orderBy($query['columns'][$query['order'][0]['column']]['name'], $query['order'][0]['dir'])->skip($page * $length)->take($length)->get()->toArray();
        }

    	foreach($data as $key=>$value) {
    		$result[$key][0] = $value['id'];
    		$category = Category::find($value['cat_id']);
    		$result[$key][1] = !empty($category) ? $category->name : '';
    		$result[$key][2] = $value['name'];
            $user = User::find($value['user_id']);
            $result[$key][3] = !empty($user) ? $user->name : 'Not found';
    		$result[$key][4] = $value['publish_at'];
    		$result[$key][5] = $value['status'];
    	}

        $json['draw'] = $req->input('draw');
        $json['recordsTotal'] = Post::count();
        $json['recordsFiltered'] = $recordsFiltered;
        $json['data'] = $result;

    	echo json_encode($json);
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

    public function loadMoreVideo ($page = 0) {
        $data = Video::orderBy('id', 'desc')->skip($page * 10)->take(10)->get()->toArray();
        foreach($data as $key=>$value) {
            $data[$key]['video_id'] = $this->getYoutubeID($value['src_video']);
            $temp = $this->getYoutubeInfo($data[$key]['video_id']);
            $data[$key]['images'] = $temp->items[0]->snippet->thumbnails->medium->url;
            $data[$key]['view'] = $temp->items[0]->statistics->viewCount;
        }
        echo json_encode($data);
    }

    // helper functions
    public function getYoutubeID ($url) {
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);
        if (isset($params['v']) && strlen($params['v']) > 0) {
            return $params['v'];
        } else {
            return "";
        }
    }

    public function getYoutubeInfo ($video_id) {
        $client = new Client();
        $res = $client->request('GET','https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id='.$video_id.'&key=' . env('YOUTUBE_API_KEY'));
        return json_decode($res->getBody());
    }
}
