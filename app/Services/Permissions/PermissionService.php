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

    public function getPermissionByModels($model)
    {
        $array = $this->model->where('name', 'like', '%' . $model . '%')->get();
        return $array;
    }

    public function getPermissionNotInModels($models)
    {
        $data = $this->model->whereIn('name', 'not like', collect($models)->map(function ($data){
            $model = [
                '%'.$data.'%'
            ];
            return $model;
        }));

        return $data;
    }
}
