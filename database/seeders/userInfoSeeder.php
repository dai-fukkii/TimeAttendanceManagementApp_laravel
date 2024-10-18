<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class userInfoSeeder extends Seeder
{
    public function run()
    {
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($i === 1){
                $users[] = [
                    'username' => 'User' . $i,
                    'password' => bcrypt('password' . $i),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'authority' => 1,
                ];
            }else{
                $users[] = [
                    'username' => 'User' . $i,
                    'password' => bcrypt('password' . $i),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'authority' => 0,
                ];
            }
            
        }

        DB::table('user_info')->insert($users);
    }
}
