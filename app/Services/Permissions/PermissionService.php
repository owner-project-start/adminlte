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
        $array = $this->model->where('name', 'like', ["%$model%"])->get();
        return $array;
    }

    public function getOtherPermission($models)
    {
        $array = $this->model->where(function ($query) use ($models) {
            foreach ($models as $model) {
                $query->Where('name', 'not like', '%' . $model . '%');
            }
        })->get();
        return $array;
    }

    public function getPermissionFormat()
    {
        foreach (Models() as $key => $model) {
            $models[$key] = [
                'model' => $model,
                'permissions' => $this->getPermissionByModels($model)
            ];
        }
        $models[count($models) + 1] = [
            'model' => 'Other',
            'permissions' => $this->getOtherPermission(Models())
        ];

        return $models;
    }
}
