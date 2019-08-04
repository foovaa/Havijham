<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentsController extends Controller
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
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     $post = Post::find($request->post_id);
 
    //     Comment::create([
    //         'content' => $request->content,
    //         'creator_id' => auth()->user()->id,
    //         'post_id' => $post->id,
    //     ]);
    //     return redirect()->route('posts.show', $post->id);
    // }




    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'creator_id' => 'required',
            'post_id' => 'required',
        ]);
        // after validation we must create a post
        // and assign the values to that
        $post = Post::find($request->post_id);
        // return $post;
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->creator_id = $request->creator_id;
        $comment->post_id = $request->post_id;
        $comment->save();

        // so we must redirect the page to the posts page
        return redirect()->route('posts.show', $post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);

        // check for unauthorized user
        if (auth()->user()->id !== $comment->creator->id) {
            return view('posts.editcommit')->with('error', 'Unauthorized user');
        }

        return view('posts.editComment')->with('comment', $comment);
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
        $this->validate($request, [
            'content' => 'required',
            'creator_id' => 'required',
            'post_id' => 'required',
        ]);
        // after validation we must create a post
        // and assign the values to that
        $post = Post::find($request->post_id);
        $comment = Comment::find($id);
        // return $post;
        $comment->content = $request->content;
        $comment->creator_id = $request->creator_id;
        $comment->post_id = $request->post_id;
        $comment->save();

        // so we must redirect the page to the posts page
        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // STATIC $temp;
        $comment = Comment::find($id);
        $post = Post::find($comment->post->id);

        if (auth()->user()->id !== $comment->creator->id) {
            return redirect()->route('posts.show', $post);
        }

        $comment->delete();
        return redirect()->route('posts.show', $post);
    }
}
