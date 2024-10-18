<?php

namespace App\Http\Controllers;

use App\Models\user_info;
use App\Models\user_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function signup(Request $request){

        if ($request->isMethod('post')) {

            $validationData = $request->validate([
                'username' => 'required|string|max:255|min:6',
                'password' => 'required|string|min:6'
            ]);

            $userCount = user_info::count();

            

            $authority = ($userCount === 0) ? 1 : 0;


            user_info::create([
                'username' => $validationData['username'],
                'password' => bcrypt($validationData['password']),
                'authority' => $authority,
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

                $userAuth = Auth::user()->authority;
                $userId =Auth::id();

                $status = user_log::select('status')
                    ->where('user_id',$userId)
                    ->orderBy('id','desc')
                    ->first();

                if ($userAuth === 1){
                    return redirect()->intended('administrator')->with('success','管理者画面に移行しました');
                }else{
                    return redirect()->intended('mytop')->with('status',$status);
                }

            }else {
                return redirect()->back()->withErrors(['login_error'=>'ユーザ名かパスワードが間違っています'])->withInput();
            }

        }

        return view('login');

    }
}
