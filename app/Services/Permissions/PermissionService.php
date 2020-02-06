<?php

namespace App\Services\Permissions;

use App\Services\BaseService;
use Spatie\Permission\Models\Permission;

class PermissionService extends BaseService
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function createPermission($attribute)
    {
        $createdObject = $this->model->create([
            'name' => $attribute['name']
        ]);
        if (!$createdObject) {
            return false;
        }
        return $createdObject;
    }
}
