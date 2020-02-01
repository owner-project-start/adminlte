<?php

namespace App\Http\Controllers\BackEnd;

use App\Services\Roles\RoleService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends ParentController
{
    /**
     * RoleController constructor.
     * @param Role $role
     * @param RoleService $roleService
     */
    public function __construct(Role $role, RoleService $roleService)
    {
        $this->model = $role;
        $this->service = $roleService;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('pages.roles.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getData()
    {
        $roles = $this->service->getSelectWithRelation(['id', 'name', 'created_at', 'updated_at'], 'permissions');

        return DataTables::of($roles)
            ->editColumn('name', function ($role) {
                return '<span class="text-capitalize">' . $role->name . '</span>';
            })
            ->addColumn('permissions', function ($role) {
                $permissionName = $role->permissions->map(function ($permission) {
                    return '<span class="badge badge-success text-capitalize">' . $permission->name . '</span>';
                })->implode(' ');
                return $permissionName;
            })
            ->filterColumn('permissions', function ($query, $keyword) {
                $query->whereRaw("permissions like ?", ["%$keyword%"]);
            })
            ->editColumn('created_at', function ($role) {
                return Carbon::parse($role->created_at)->format('M-d-Y');
            })
            ->editColumn('updated_at', function ($role) {
                return Carbon::parse($role->created_at)->format('M-d-Y');
            })
            ->addColumn('action', function ($role) {
                $action = "";
                if (auth()->user()->can('view-roles')) {
                    $action = $action . ' <a href="' . route('roles.edit', $role->id) . '" class="btn btn-primary btn-sm btn-x-sm"><i class="far fa-eye"></i></a>';
                }
                if (auth()->user()->can('edit-roles')) {
                    $action = $action . ' <a href="' . route('roles.edit', $role->id) . '" class="btn btn-info btn-sm btn-x-sm"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (auth()->user()->can('delete-roles')) {
                    $action = $action . ' <button type="button" data-remote="' . route('roles.delete', $role->id) . '" class="btn btn-danger btn-sm btn-x-sm" id="delete"><i class="far fa-trash-alt"></i></button>';
                }
                return $action;
            })
            ->rawColumns(['name', 'action', 'permissions', 'created_at', 'updated_at'])
            ->make(true);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        return parent::delete($id);
    }
}
