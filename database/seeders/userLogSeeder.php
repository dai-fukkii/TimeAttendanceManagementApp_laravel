<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class userLogSeeder extends Seeder
{
    public function run()
    {
        $logs = [];
        
        for ($userId = 1; $userId <= 5; $userId++) {
            $faker = Faker::create('ja_JP');
            for ($i = 0; $i < 5; $i++) {
                $logs[] = [
                    'user_id' => $userId,
                    'username' => $faker->name,
                    'status' => $this->getRandomStatus(),
                    'created_at' => Carbon::now()->subHours(rand(1, 100)),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('user_log')->insert($logs);
    }

    private function getRandomStatus()
    {
        $statuses = ['clock_in', 'break_in', 'break_out', 'clock_out'];
        return $statuses[array_rand($statuses)];
    }
}
