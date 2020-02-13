<?php

namespace App\Http\Controllers\BackEnd;

use App\Services\Permissions\PermissionService;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends ParentController
{
    /**
     * PermissionController constructor.
     * @param Permission $permission
     * @param PermissionService $permissionService
     */
    public function __construct(Permission $permission, PermissionService $permissionService)
    {
        $this->model = $permission;
        $this->service = $permissionService;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('pages.permissions.index');
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getData()
    {
        $permissions = $this->service->getSelect(['id', 'name', 'created_at', 'updated_at']);
        return DataTables::of($permissions)
            ->editColumn('name', function ($permission) {
                $permissionName = str_replace('-', ' ', $permission->name);
                return '<span class="text-capitalize">' . $permissionName . '</span>';
            })
            ->addColumn('code', function ($permission) {
                return $permission->name;
            })
            ->editColumn('created_at', function ($permission) {
                return Carbon::parse($permission->created_at)->format('M-d-Y');
            })
            ->editColumn('updated_at', function ($permission) {
                return Carbon::parse($permission->created_at)->format('M-d-Y');
            })
            ->addColumn('action', function ($permission) {
                $action = "";
//                if (auth()->user()->can('edit-permissions')) {
//                    $action = $action . ' <a href="' . route('roles.edit', $permission->id) . '" class="btn btn-info btn-sm btn-x-sm"><i class="fas fa-pencil-alt"></i></a>';
//                }
                if (auth()->user()->can('delete-permissions')) {
                    $action = $action . ' <button type="button" data-remote="' . route('permissions.delete', $permission->id) . '" class="btn btn-danger btn-sm btn-x-sm" id="delete"><i class="far fa-trash-alt"></i></button>';
                }
                return $action;
            })
            ->rawColumns(['name', 'created_at', 'updated_at', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('pages.permissions.create');
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4|unique:permissions,name'
        ]);
        DB::beginTransaction();
        $createdObject = $this->service->createPermission($request->all());
        if (!$createdObject) {
            DB::rollBack();
            return error('Record not saved');
        }
        DB::commit();
        roleAdmin()->givePermissionTo($createdObject);
        toastSuccess('Record has been saved Successfully');
        return redirect()->route('permissions');
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
