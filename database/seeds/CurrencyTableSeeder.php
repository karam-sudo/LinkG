<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->delete();

        $currencies = [
            ['en'=> 'SP', 'ar'=> "ليرة سورية"],
            ['en'=> 'AED', 'ar'=> "درهم اماراتي"],
            ['en'=> 'USD', 'ar'=> "دولار امريكي"],

        ];
        foreach ($currencies as $currency) {
            Currency::create(['Name' => $currency]);
        }
    }
}
