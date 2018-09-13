<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    public $timestamps = false;
    protected $fillable = [
        'name','description'
    ];
    protected $hidden = ['pivot'];

    public $validationRules = [
        'name' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255|unique:roles',
        'description' => 'required|max:255'
    ];
}
