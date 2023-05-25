<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0;$i<200;$i++){
            \App\People::create([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'phone'=>$faker->phoneNumber,
                'gender'=>$faker->text
            ]);
        }
    }
}
