<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      

       
        $this->call(GenderTableSeeder::class);
        $this->call(JobTimeTableSeeder::class);
        $this->call(JobTypeTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
    
    }
}
