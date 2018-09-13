<?php

use Illuminate\Database\Seeder;
use App\Models\RoleUser;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i = 1; $i < 4; $i++) {
            RoleUser::create([
                'user_id' => $i,
                'role_id' => $i
            ]);
        }
    }
}
