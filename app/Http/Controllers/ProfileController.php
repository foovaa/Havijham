<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Auth;
use Image;

class ProfileController extends Controller
{
    public function profile() {
        return view('profile.profile')->with('user', Auth::user());
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


        return view('profile.profile')->with('user', Auth::user());
    }

}
