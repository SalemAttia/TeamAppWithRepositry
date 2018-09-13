<?php

namespace App\Repos;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class RoleRepo extends AbstractRepo
{
    public function __construct()
    {
        $this->model = new Role();
    }

}