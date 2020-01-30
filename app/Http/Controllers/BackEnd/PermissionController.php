<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\ParentController;
use App\Services\Permissions\PermisssionService;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends ParentController
{
    public function __construct(Permission $permission, PermisssionService $permisssionService)
    {
        $this->model = $permission;
        $this->service = $permisssionService;
    }

    public function index()
    {
        return view('pages.permissions.index');
    }

    public function getData()
    {
        $permissions = $this->service->getSelect(['id', 'name', 'created_at', 'updated_at']);

        return DataTables::of($permissions)
            ->make(true);
    }
}
