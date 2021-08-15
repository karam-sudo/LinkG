<?php

use Illuminate\Database\Seeder;
use App\Models\JobTime;
use Illuminate\Support\Facades\DB;

class JobTimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_times')->delete();

        $job_times = [
            ['en'=> "Full Time", 'ar'=> "دوام كامل"],
            ['en'=> "Part Time", 'ar'=> "دوام جزئي"],

        ];
        foreach ($job_times as $job_time) {
            JobTime::create(['Name' => $job_time]);
        }
    }
}
