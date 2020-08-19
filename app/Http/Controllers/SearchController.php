<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Database\Eloquent\Collection;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post()
    {
        $query = request('query');

        $posts = Post::where("title", "like", "%$query%")->latest()->paginate(10);

        return view('post.index', compact('posts'));
    }
}
