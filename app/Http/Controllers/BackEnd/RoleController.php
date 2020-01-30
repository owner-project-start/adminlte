<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\ParentController;
use App\Services\Roles\RoleService;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends ParentController
{
    public function __construct(Role $role, RoleService $roleService)
    {
        $this->model = $role;
        $this->service = $roleService;
    }

    public function index()
    {
        return view('pages.roles.index');
    }

    public function getData()
    {
        $roles = $this->service->getSelect(['id', 'name', 'created_at', 'updated_at']);

        return DataTables::of($roles)
            ->editColumn('name', function ($role) {
                return '<span class="text-capitalize">' . $role->name . '</span>';
            })
            ->addColumn('action', function ($role) {
                $action = "";
                $action = $action . ' <a href="' . route('roles.edit', $role->id) . '" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>';
                $action = $action . ' <a href="' . route('roles.edit', $role->id) . '" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $action = $action . ' <button type="button" data-remote="' . route('roles.delete', $role->id) . '" class="btn btn-danger btn-sm" id="delete"><i class="far fa-trash-alt"></i></button>';
                return $action;
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }
}
