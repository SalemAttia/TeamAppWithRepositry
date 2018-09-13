<?php

use Illuminate\Database\Seeder;
use App\Models\TeamUser;

class UserTeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i = 1; $i < 4; $i++) {
            TeamUser::create([
                'user_id' => $i,
                'team_id' => $i
            ]);
        }
    }
}
