<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_info;
use App\Models\user_log;
use Illuminate\Support\Facades\Auth;

class UserLogsController extends Controller
{
    public function userinfos(){

        $userInfo = Auth::user();

        return view('mytop', compact('userInfo'));
    }

    public function userlogs(){

        $userInfo = Auth::user();

        return view('test', compact('userInfo'));

    }
}
