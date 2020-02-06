<?php

namespace App\Services\Roles;

use App\Services\BaseService;
use Spatie\Permission\Models\Role;

class RoleService extends BaseService
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }


    public function createRole($attribute)
    {
        $createdObject = $this->model->create([
            'name' => $attribute['name']
        ]);
        if (!$createdObject) {
            return false;
        }
        return $createdObject;
    }

    public function updateRole($id, $attribute)
    {
        $modelObj = $this->getById($id);
        if (!$modelObj) {
            false;
        }
        $result = $modelObj->fill([
            'name' => $attribute->name
        ]);
        $result->update();
        return $result;
    }
}
