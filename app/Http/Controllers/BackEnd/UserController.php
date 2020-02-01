<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use App\Services\Roles\RoleService;
use App\Services\Users\UserService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

/**
 * @property RoleService role
 */
class UserController extends ParentController
{
    /**
     * UserController constructor.
     * @param User $user
     * @param UserService $userService
     * @param RoleService $roleService
     */
    public function __construct(User $user, UserService $userService, RoleService $roleService)
    {
        $this->model = $user;
        $this->service = $userService;
        $this->role = $roleService;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        // return to view index page of users
        return view('pages.users.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getData()
    {
        // select users field
        $users = $this->service->getSelectWithRelation(['id', 'name', 'email', 'created_at', 'updated_at'], 'roles');
        // return data tables with field selected
        return DataTables::of($users)
            ->editColumn('name', function ($user) {
                return '<span class="text-capitalize">' . $user->name . '</span>';
            })
            ->addColumn('roles', function ($user) {
                return '<span class="badge badge-success text-capitalize">' . $user->roles->pluck('name')->implode('') . '</span>';
            })
            ->filterColumn('roles', function ($query, $keyword) {
                $query->whereRaw("roles like ?", ["%$keyword%"]);
            })
            ->editColumn('created_at', function ($role) {
                return Carbon::parse($role->created_at)->format('M-d-Y');
            })
            ->editColumn('updated_at', function ($role) {
                return Carbon::parse($role->created_at)->format('M-d-Y');
            })
            ->addColumn('action', function ($user) {
                $action = "";
                if (auth()->user()->can('view-users')) {
                    $action = $action . ' <a href="' . route('users.edit', $user->id) . '" class="btn btn-primary btn-sm btn-x-sm"><i class="far fa-eye"></i></a>';
                }
                if (auth()->user()->can('edit-users')) {
                    $action = $action . ' <a href="' . route('users.edit', $user->id) . '" class="btn btn-info btn-sm btn-x-sm"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (auth()->user()->can('delete-users')) {
                    $action = $action . ' <button type="button" data-remote="' . route('users.delete', $user->id) . '" class="btn btn-danger btn-sm btn-x-sm" id="delete"><i class="far fa-trash-alt"></i></button>';
                }
                if (auth()->user()->can('change-password-users')) {
                    $action = $action . ' <a href="' . route('users.edit', $user->id) . '" class="btn btn-warning btn-sm btn-x-sm"><i class="fas fa-sync-alt"></i></a>';
                }
                return $action;
            })
            ->rawColumns(['name', 'roles', 'action'])
            ->make(true);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $roles = $this->role->all();
        return view('pages.users.create', compact('roles'));
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $objectCreate = parent::store($request);
            if ($objectCreate instanceof $this->model) {
                if (isset($request->roles)) {
                    $roles = $this->role->getByArray('id', $request->roles);
                    $objectCreate->assignRole($roles);
                } else {
                    return error();
                }
                DB::commit();
                toastSuccess('Data has been saved successfully!');
                return redirect()->route('users');
            }
            toastError('Missing Fill');
            return error_notFound();
        } catch (ValidationException $validate) {
            DB::rollBack();
            return back()->withErrors($validate->errors())->withInput();
        }
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        // find user from service
        $user = $this->service->getById($id);
        $roles = $this->role->all();
        return view('pages.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        return parent::update($request, $id);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }
}
