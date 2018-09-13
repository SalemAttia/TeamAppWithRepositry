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

    public function update($idOrModel, $data)
    {
        $this->model->validationRules['name'] = 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255|unique:roles,name,' . $idOrModel;
        return parent::update($idOrModel, $data);
    }
}