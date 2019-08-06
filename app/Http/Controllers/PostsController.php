<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
// add Post model for using its functions
use App\Post;
use App\User;
use App\Comment;

// this controller made with command:
// php artisan make:controller PostsController --resource
// i think that it makes functions of below

class PostsController extends Controller
{

    /**
     * we must create this constructor for authentication
     * also we except the 'index' and 'show'
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('approved', '1')->orderBy('created_at', 'desc')->paginate(10);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        // after validation we must create a post
        // and assign the values to that
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->save();

        // so we must redirect the page to the posts page
        Session::flash('success', 'پست شما پس از بررسی در سایت قرار می گیرد');
        return redirect('dashboard')->with('user', Auth::user());
        
        // return redirect('/posts')->with('success', 'پست شما پس از بررسی در سایت قرار خواهد گرفت');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::find($id);
        // $comments = Comment::all()->find($id);
        // dd($post->comments->all());
        // foreach ($post->comments->all() as $item ) {
        //     echo "{$item->creator->name}";
        // }
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // check for unauthorized user
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'کاربر غیر مجاز');
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // all we have to do is like create function
        // just we don't make a new post 
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        // save the same post with new content
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->approved = false;
        $post->save();

        // so we must redirect the page to the posts page
        Session::flash('success', 'پست شما پس از بررسی در سایت قرار می گیرد');
        return redirect('dashboard')->with('user', Auth::user());


        // return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // check for unauthorized user
        if (auth()->user()->id !== $post->user_id) {
        return redirect('dashboard')->with('user', Auth::user());
        // return redirect('/posts')->with('error', 'Unauthorized user');
    }
        $post->delete();

        Session::flash('error', 'پست شما پاک شد');
        return redirect('dashboard')->with('user', Auth::user());
        
        // Seossion::flash('Post removed');
    }
}
