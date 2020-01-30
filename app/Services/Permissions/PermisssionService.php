<?php

namespace App\Services\Permissions;

use App\Services\BaseService;
use Spatie\Permission\Models\Permission;

class PermisssionService extends BaseService
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }
}
