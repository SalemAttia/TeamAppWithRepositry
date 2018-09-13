<?php

namespace App\Repos;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class TeamRepo extends AbstractRepo
{
    public function __construct()
    {
        $this->model = new Team();
    }

}