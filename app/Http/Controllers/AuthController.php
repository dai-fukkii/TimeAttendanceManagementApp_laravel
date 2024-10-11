<?php

namespace App\Http\Controllers;

use App\Models\user_info;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup(Request $request){

        if ($request->isMethod('post')) {

            $validationData = $request->validate([
                'username' => 'required|string|max:255|min:6',
                'password' => 'required|string|min:6'
            ]);


            user_info::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                ]);

            return redirect()->route('login')->with('success','ユーザが作成されました');
        }

        return view('signup');
    }
}
