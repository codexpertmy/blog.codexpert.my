<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate();
        return view('home')->with(compact('posts'));
    }

    public function create()
    {
        return view('blog_create');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'body' => 'required',
        ]);

        $seoKeywords = explode(' ', $request->input('seo_keywords'));
        $post = Post::create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'title' => $request->get('title'),
            'sub_title' => $request->get('sub_title'),
            'category_id' => $request->get('category_id'),
            'published' => $request->get('published'),
            'body' => $request->get('body'),
            'seo_keywords' => $seoKeywords,
        ]);

        return redirect()->back()->with('status', 'Post added.');
    }

    /**
     * @param $hashId
     */
    public function edit($hashId)
    {
        $post = Post::hashId($hashId)->first();
        return view('blog_update')->with(compact('post'));
    }

    /**
     * @param Request   $request
     * @param $hashId
     */
    public function update(Request $request, $hashId)
    {
        $post = Post::hashId($hashId)->first();
        $seoKeywords = explode(' ', $request->get('seo_keywords'));
        $request->merge(['seo_keywords' => $seoKeywords]);

        $post->update($request->except('_token', 'method'));
        return redirect()->back()->with('_message', 'Success');

    }

    /**
     * @param $hashId
     */
    public function togglePublished($hashId)
    {
        $post = Post::hashId($hashId)->first();
        $post->togglePublished();
        return redirect()->back()->with('_message', 'Success');
    }

    /**
     * @param $hashId
     */
    public function delete($hashId)
    {
        $post = Post::hashId($hashId)->first();
        $post->delete();
        return redirect()->back()->with('_message', 'Success');

    }
}
