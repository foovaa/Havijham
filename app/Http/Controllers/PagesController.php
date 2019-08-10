<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function about(){
        return view('pages.about');
    }

    public function users() {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('pages.users')->with('users', $users); 
    }

    public function user($id) {
        $user = User::find($id);
        if ($user) {
            $posts = Post::where(['user_id' => $user->id, 'approved' => true])->orderBy('created_at', 'desc')->get();
            // dd($posts->all());
            $data = array(
                'user' => $user,
                'posts' => $posts,
            ); 
            return view('pages.user')->with('data', $data);
        }
        Session::flash('error', 'همچین عضوی پیدا نشد');
        return redirect()->route('users');

    }

}
