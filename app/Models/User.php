<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mockery\Exception;

class User extends Authenticatable
{
    use  Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public $validationRules = [
        'name' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','pivot'
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function teams()
    {
        return $this->BelongsToMany(Team::class);
    }

    public function roles()
    {
        return $this->BelongsToMany(Role::class,'user_role');
    }

    public function SetTeams($teams)
    {

            foreach ($teams as $team) {
                try {
                    TeamUser::firstOrCreate([
                            'user_id' => $this->id,
                            'team_id' => $team
                        ]
                    );
                } catch (\Illuminate\Database\QueryException $e) {

                    // Error form database
//                    return false;
                }
            }
            return true;
    }

    public function SetUserTeamOwner($team)
    {
        try {
            $teamOwner = TeamUser::firstOrCreate([
                    'user_id' => $this->id,
                    'team_id' => $team,
                ]
            );

            $teamOwner->update([
                'owner' => 1
            ]);
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
                // db QueryException
            return false;
        }
    }

    public function SetUserRole($role)
    {
        try {
            $userRole = RoleUser::firstOrCreate([
                    'user_id' => $this->id,
                    'role_id' => $role,
                ]
            );

            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            // db QueryException
            return false;
        }
    }
}
