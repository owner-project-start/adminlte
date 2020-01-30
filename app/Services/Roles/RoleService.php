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

    public function getRoles()
    {
        $objects = $this->model->all();
        if ($objects) {
            return $objects;
        }
        return false;
    }
}
