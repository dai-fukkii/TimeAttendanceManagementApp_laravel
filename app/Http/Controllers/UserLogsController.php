<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_info;
use App\Models\user_log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;

class UserLogsController extends Controller
{
    public function userinfos(){

        $userInfo = Auth::user();

        return view('mytop', compact('userInfo'));
    }

    public function attendanceRegister(Request $request){

        

        try {

            $userInfo = Auth::id();
            $userName = Auth::user()->username;
            $status = $request->input('action');
            $currentTime = Carbon::now()->format('Y-m-d H:i:s');

            user_log::create([
                'user_id'=>$userInfo,
                'username'=>$userName,
                'status'=>$status,
            ]);

            return response()->json([
                'message'=> '入力が完了しました',
                'status'=>$status,
                'current_time'=>$currentTime,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'id'=>$userInfo,
                'message'=>'エラーが発生しました',
                'error'=>$e->getMessage(),
            ]);
        }
        

    }

    public function userlogs(){

        try{
            $userId = Auth::id();

            $userLogs = user_log::where('user_id', $userId)->get();

            return response()->json([
                'user_id' => $userId,
                'logs' => $userLogs,
            ]);

        }catch(Exception $e){

            return response()->json([
                'message' => 'ログが読み込まれませんでした',
                'error' => $e->getMessage()
            ]);

        }

    }
}