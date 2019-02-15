<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $posts = Post::published()->latest()->get();
        return view('welcome')->with(compact('posts'));
    }

    /**
     * @param $hashid
     * @param $slug
     */
    public function show($hashid, $slug)
    {
        $post = Post::hashId($hashid)->slug($slug)->firstOrFail();
        $relatedPost = Post::byCategory([$post->category_id])
            ->whereNotIn('hash_id', [$hashid])->get();

        return view('blog')->with(compact('post', 'relatedPost'));
    }

    /**
     * @param $category
     */
    public function byCategory($category)
    {
        $category = str_replace('_', ' ', $category);

        $posts = Post::whereHas('category', function ($query) use ($category) {
            $query->where('name', $category);
        })->get();

        return view('blog_related')->with(compact('posts'));
    }
}
