<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TeamUser extends Model
{
    protected $table = 'team_user';
    public $timestamps = false;
    protected $fillable = [
        'team_id','user_id','owner'
    ];

}