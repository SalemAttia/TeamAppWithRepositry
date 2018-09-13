<?php

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();


        for ($i = 0; $i < 5; $i++) {
            Team::create([
                'title' => $faker->name,
            ]);
        }
    }
}
