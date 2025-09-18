<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::latest('published_at')
            ->where('status','published')
            ->paginate(4);

        // untuk sidebar "recent posts"
        $recentPosts = Post::latest('published_at')
            ->where('status','published')
            ->take(3)
            ->get();

        return view('blogarchive', compact('posts','recentPosts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug',$slug, 'pokdarwis')
            ->where('status','published')
            ->firstOrFail();

        // recent posts sidebar
        $recentPosts = Post::latest('published_at')
            ->where('id','!=',$post->id)
            ->where('status','published')
            ->take(3)
            ->get();

        return view('blogSingle', compact('post','recentPosts'));
    }
}
