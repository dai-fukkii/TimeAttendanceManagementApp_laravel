<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user_log;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminInfo(){

        $userInfo = Auth::user();

        return view('administrator', compact('userInfo'));

    }

    public function adminStatus(Request $request){

        $status = $request->input('status');

        switch($status){
            case 'active':
                $q_status = ['clock_in','break_out'];
                break;
            case 'break':
                $q_status = ['break_in'];
                break;
            case 'inactive':
                $q_status = ['clock_out'];
                break;
            default:
                break;
        }

        $logs = user_log::select('user_id','username','status','created_at')
            ->whereIn('status', $q_status)
            ->whereIn('id', function($query){
                $query->select(DB::raw('MAX(id)'))
                    ->from('user_log')
                    ->groupBy('user_id');
            })
            ->get();
        // $logs = user_log::whereIn('status',$q_status)->get();

        return response()->json([
            'status'=>$status,
            'logs' => $logs,
        ]);
    }
}
