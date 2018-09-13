<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'user_role';
    public $timestamps = false;
    protected $fillable = [
        'role_id','user_id'
    ];


}