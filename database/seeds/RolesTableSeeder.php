<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
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
            Role::create([
                'name' => $faker->name,
                'description' => $faker->sentence,
            ]);
        }
    }

}
