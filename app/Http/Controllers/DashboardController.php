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
            Session::flash('error', 'کاربر غیر مجاز');
        }
        $posts = Post::where(['approved' => false, 'review' => false])->get();
        // dd($posts);
        $comments = Comment::where('approved', false)->get();
        $data = array(
            'posts' => $posts,
            'comments' => $comments,
        );
        return view('pages.admin')->with('data', $data);
        // return view('pages.check')->with(['posts' => $posts, 'comments' => $comments]);
    }

    // public function postShow($id) {
    //     $post = Post::find($id);
    //     return view('pages.showPost')->with('post', $post);
    // }

    public function update(Request $request) {
        // in here we need interventioni/image
        $this->validate($request, [
            'avatar' => 'mimes:jpeg,png,bmp,tiff |max:1999',
        ], 
          $messages = [
            'mimes' => 'فورمت های عکس jpeg, png, bmp فقط قبوله.'
        ]
    );
        if ($request->hasFile('avatar')) {

            if (Auth::user()->avatar !== 'default.svg') {
                Storage::delete('/public/avatar/'.Auth::user()->avatar);
            }
            $avatar = $request->file('avatar');
            $filename = time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path("storage/avatar/".$filename));
        } else {
            $filename = Auth::user()->avatar;
        }
        $user = Auth::user();
        if ($request->about_me) {
            $about_me = $request->about_me;
            if (strlen($about_me) > 1000) {
                $about_me = substr($about_me, 0, 999);
            }
            $user->about_me = $about_me;
        }
        $user->avatar = $filename;
        $user->save();

        return redirect()->route('dashboard', Auth::user());
        // return view('pages.dashboard')->with('user', Auth::user());
    }


    public function writterShow($id) {
        $post = Post::find($id);
        if ($post && Auth::user()->id == $post->user->id) {
            return view('posts/writterShow')->withPost($post);
        }
        Session::flash('error', 'کاربر غیر مجاز');
        return redirect('/');
    }


}
