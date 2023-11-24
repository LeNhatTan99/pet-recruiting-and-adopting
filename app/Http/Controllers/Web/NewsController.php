<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
        /**
    * view index list adoption aplication
    * @return \Illuminate\Contracts\View\View|View
    */
    public function index(Request $request) {
        $datas = News::query();
        $datas->join('users', 'forum_posts.user_id', '=', 'users.id')
            ->leftJoin('media', 'media.forum_post_id', '=', 'forum_posts.id')
            ->select('forum_posts.*', 'users.username', 'users.first_name', 
                      'users.last_name', 'users.email', 'users.phone_number', 
                      'users.address',
                      DB::raw('JSON_ARRAYAGG(JSON_OBJECT("url", media.url, "type", media.type)) as media_info'))
            ->groupBy(
                'forum_posts.id',
            )
            ->orderBy('forum_posts.created_at', 'desc');
        if(isset($request->search)) {
            $searchTerm = $request->search;
            $datas->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%');
            });
        }
        $datas = $datas->paginate(10);
        return view('pages.news.index', compact('datas'));
    }

}
