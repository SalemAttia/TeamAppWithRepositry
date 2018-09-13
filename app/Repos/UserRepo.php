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

    public function update($idOrModel, $data)
    {
        $this->model->validationRules['email'] = 'required|email|unique:users,email,'.$idOrModel;
        return parent::update($idOrModel, $data);
    }

}