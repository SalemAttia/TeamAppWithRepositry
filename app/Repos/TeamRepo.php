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

    public function update($idOrModel, $data)
    {
        $this->model->validationRules['title'] = 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255|unique:teams,title,'.$idOrModel;
        return parent::update($idOrModel, $data);
    }

}