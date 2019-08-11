<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weathers')->insert([
          'city' => str_random(10),
          'temperature' => rand(-5, 30),
          'humidity' => rand(2, 5),
          'wind_speed' => rand(0, 15),
          'pressure' =>  rand(700, 900),
        ]);
    }
}
