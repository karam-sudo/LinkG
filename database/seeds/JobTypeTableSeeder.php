<?php

use Illuminate\Database\Seeder;
use App\Models\JobType;
use Illuminate\Support\Facades\DB;

class JobTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_types')->delete();

        $job_types = [
            ['en'=> 'OnSite', 'ar'=> "في الشركة"],
            ['en'=> 'OnLine', 'ar'=> "عن بعد"],

        ];
        foreach ($job_types as $job_type) {
            JobType::create(['Name' => $job_type]);
        }
    }
}
