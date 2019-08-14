<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Auth;

use Session;

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
    //     return redirect()->route('show', $post->id);
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
        Session::flash('success', 'نظر شما پس از بررسی اعمال خواهد شد');
        return redirect()->route('show', $post);

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
            Session::flash('error', 'کاربر غیر مجاز');
            return redirect()->route('show', $comment->post);
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
        ]);
        // after validation we must create a post
        // and assign the values to that
        $comment = Comment::find($id);
        $comment->content = $request->content;
        $comment->approved = false;
        $comment->update();

        // so we must redirect the page to the posts page
        Session::flash('message', 'نظر شما پس از بررسی اعمال خواهد شد');
        return redirect()->route('show', $comment->post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post = Post::find($comment->post->id);

        if (auth()->user()->id !== $comment->creator->id) {
            Session::flash('error', 'کاربر غیر مجاز');
            return redirect()->route('show', $post);
        }

        $comment->delete();
        Session::flash('success', 'کامنت مورد نظر پاک شد');
        return redirect()->route('show', $post);
    }


    public function destroyComment($id) {
        $comment = Comment::find($id);
        if (Auth::user()->is_admin) {
            $comment->delete();
            $posts = Post::all();
            $comments = Comment::all();
            $data = array(
                'posts' => $posts,
                'comments' => $comments,
            );
            // return redirect('/dashboard/{ Auth::user->id }/admin')->with('data', $data);
            return redirect()->route('admin', auth()->user()->id);
            Session::flash('success', 'کامنت شما پاک شد');    
        }
        return redirect('/index');
        Session::flash('error', 'کاربر غیر مجاز');
        // return redirect('pages.index')->with('error', 'کاربر غیر مجاز');
    }

    public function commentApprove($id) {
        $comment = Comment::find($id);
        if (Auth::user()->is_admin) {
            $comment->approved = true;
            $comment->save();
            $posts = Post::all();
            $comments = Comment::all();
            $data = array(
                'posts' => $posts,
                'comments' => $comments,
            );
            // return redirect('/dashboard/{ Auth::user->id }/admin')->with('data', $data);
            return redirect()->route('admin', auth()->user()->id);
            Session::flash('success', 'کامنت تایید شد');    
        }
        return redirect('/index');
        Session::flash('error', 'کاربر غیر مجاز');
        // return redirect('pages.index')->with('error', 'کاربر غیر مجاز');
    }


}
