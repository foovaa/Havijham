<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

use App\User;
use App\Post;
use App\Comment;
use Image;
use Auth;

class DashboardController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        // return $user->posts;
        return view('pages.dashboard')->with('user', $user);
    }

    public function admin($id) {
        $user = User::find($id);
        // dd($user);
        if (! $user->is_admin) {
            return redirect('/');
            Session::flash('error', 'Unauthorized user');
        }
        $posts = Post::all();
        $comments = Comment::all();
        $data = array(
            'posts' => $posts,
            'comments' => $comments,
        );
        return view('pages.check')->with('data', $data);
        // return view('pages.check')->with(['posts' => $posts, 'comments' => $comments]);
    }

    public function postShow($id) {
        $post = Post::find($id);
        return view('pages.showPost')->with('post', $post);
    }

    public function update(Request $request) {
        // in here we need interventioni/image
        if ($request->hasFile('avatar')) {
            if (Auth::user()->avatar !== 'default.svg') {
                Storage::delete('/public/avatar/'.Auth::user()->avatar);
            }
            $avatar = $request->file('avatar');
            $filename = time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(200, 200)->save(public_path("storage/avatar/".$filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('pages.dashboard')->with('user', Auth::user());
    }

    public function destroyPost($id) {
        $post = Post::find($id);
        if (Auth::user()->is_admin) {
            $post->delete();
            $posts = Post::all();
            $comments = Comment::all();
            $data = array(
                'posts' => $posts,
                'comments' => $comments,
            );
            // return redirect('/dashboard/{ Auth::user->id }/admin')->with('data', $data);
            return redirect()->route('pages.check', auth()->user()->id);
            Session::flash('success', 'Post Removed');    
        }
        return redirect('pages.index')->with('error', 'Unauthorized user');
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
            return redirect()->route('pages.check', auth()->user()->id);
            Session::flash('success', 'Comment Removed');    
        }
        return redirect('pages.index')->with('error', 'Unauthorized user');
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
            return redirect()->route('pages.check', auth()->user()->id);
            Session::flash('success', 'Comment approved');    
        }
        return redirect('pages.index')->with('error', 'Unauthorized user');
    }

    public function postApprove($id) {
        $post = Post::find($id);
        if (auth()->user()->is_admin) {
            $post->approved = true;
            $post->save();
            $posts = Post::all();
            $comments = Comment::all();
            $data = array(
                'posts' => $posts,
                'comments' => $comments,
            );
            return redirect()->route('pages.check', auth()->user()->id);
            Session::flash('success', 'Post approved');    
        }
        return redirect('/index');
        Session::flash('error', 'Unathoorized user');
    }

}
