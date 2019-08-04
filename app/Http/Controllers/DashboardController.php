<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
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
        return view('dashboard')->with('user', $user);
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


        return view('dashboard')->with('user', Auth::user());
    }


}
