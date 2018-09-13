<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    public $timestamps = false;
    protected $fillable = [
        'title'
    ];
    protected $hidden = ['pivot'];
    public $validationRules = [
        'title' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255|unique:teams'
    ];


    public function users()
    {
        return $this->BelongsToMany(User::class);
    }


}
