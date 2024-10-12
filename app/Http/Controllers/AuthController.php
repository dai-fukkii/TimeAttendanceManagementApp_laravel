<?php

namespace App\Http\Controllers;

use App\Models\user_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request){

        if ($request->isMethod('post')) {

            $validationData = $request->validate([
                'username' => 'required|string|max:255|min:6',
                'password' => 'required|string|min:6'
            ]);


            user_info::create([
                'username' => $validationData['username'],
                'password' => bcrypt($validationData['password']),
                ]);

            return redirect()->route('login')->with('success','ユーザが作成されました');
        }

        return view('signup');
    }

    public function login(Request $request){

        if ($request->isMethod('post')) {

            $validationData = $request->validate([
                'username' => 'required|string|max:255|min:6',
                'password' => 'required|string|min:6',
            ]);

            if (Auth::attempt(['username'=>$validationData['username'], 'password'=>$validationData['password']])) {
                return redirect()->intended('mytop')->with('success','ログインに成功しました');
            }else {
                return redirect()->back()->withErrors(['login_error'=>'ユーザ名かパスワードが間違っています'])->withInput();
            }

        }

        return view('login');

    }
}
