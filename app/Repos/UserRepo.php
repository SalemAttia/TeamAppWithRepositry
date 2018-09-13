<?php

namespace App\Repos;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepo extends AbstractRepo
{
    public function __construct()
    {
        $this->model = new User();
    }

}