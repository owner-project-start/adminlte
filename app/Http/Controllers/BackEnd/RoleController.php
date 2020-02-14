<?php

namespace App\Http\Controllers\BackEnd;

use App\Services\Permissions\PermissionService;
use App\Services\Roles\RoleService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

/**
 * @property PermissionService permission
 */
class RoleController extends ParentController
{
    /**
     * RoleController constructor.
     * @param Role $role
     * @param RoleService $roleService
     * @param PermissionService $permissionService
     */
    public function __construct(Role $role, RoleService $roleService, PermissionService $permissionService)
    {
        $this->model = $role;
        $this->service = $roleService;
        $this->permission = $permissionService;
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
            ->editColumn('created_at', function ($role) {
                return Carbon::parse($role->created_at)->format('M-d-Y');
            })
            ->editColumn('updated_at', function ($role) {
                return Carbon::parse($role->created_at)->format('M-d-Y');
            })
            ->editColumn('name', function ($role) {
                return '<span class="text-capitalize">' . $role->name . '</span>';
            })
            ->addColumn('code', function ($role) {
                return $role->name;
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
            ->addColumn('action', function ($role) {
                $action = "";
                if (auth()->user()->can('edit-roles')) {
                    $action = $action . ' <a href="' . route('roles.edit', $role->id) . '" class="btn btn-info btn-sm btn-x-sm"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (auth()->user()->can('delete-roles')) {
                    $action = $action . ' <button type="button" data-remote="' . route('roles.delete', $role->id) . '" class="btn btn-danger btn-sm btn-x-sm" id="delete"><i class="far fa-trash-alt"></i></button>';
                }
                return $action;
            })
            ->orderColumn('created_at', '-created_at')
            ->rawColumns(['name', 'action', 'permissions', 'created_at', 'updated_at'])
            ->make(true);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $permissions = $this->permission->all();
        return view('pages.roles.create', compact('permissions'));
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name|min:4'
        ]);
        DB::beginTransaction();
        $createdObject = $this->service->createRole($request->all());
        if ($createdObject) {
            if (!empty($request->permissions)) {
                $getArray = $this->permission->getByArray('id', $request->permissions);
                $createdObject->givePermissionTo($getArray);
            }
            DB::commit();
            toastSuccess('Record has been saved successfully!');
            return redirect()->route('roles');
        }
        DB::rollBack();
        return error_notFound();
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        // try to find record
        $role = $this->service->getById($id);
        // try to get all permission
        $permissions = $this->permission->all();
        return view('pages.roles.edit', compact('role', 'permissions'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse|RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $this->validate($request, [
                'name' => 'required|min:4|unique:roles,name,'.$id
            ]);
            $updatedObject = $this->service->updateRole($id, $request);
            if ($updatedObject) {
                if (!empty($request->permissions)) {
                    $getArray = $this->permission->getByArray('id', $request->permissions);
                    $updatedObject->syncPermissions($getArray);
                } else {
                    $updatedObject->syncPermissions('');
                }
            }
            DB::commit();
            toastSuccess('Record has been updated successfully!');
            return redirect()->route('roles');
        }
        return error("Record id is required");
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
