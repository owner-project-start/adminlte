<?php

namespace App\Http\Controllers\BackEnd;

use App\Services\Permissions\PermisssionService;
use Carbon\Carbon;
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
            ->editColumn('name', function ($role) {
                return '<span class="text-capitalize">' . $role->name . '</span>';
            })
            ->editColumn('created_at', function ($role) {
                return Carbon::parse($role->created_at)->format('M-d-Y');
            })
            ->editColumn('updated_at', function ($role) {
                return Carbon::parse($role->created_at)->format('M-d-Y');
            })
            ->rawColumns(['name', 'created_at', 'updated_at'])
            ->make(true);
    }
}
