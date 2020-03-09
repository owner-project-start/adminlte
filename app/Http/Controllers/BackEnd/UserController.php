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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
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
        return view('pages.assessments.users.index');
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
                $roleName = $user->roles->map(function ($role) {
                    return '<span class="badge badge-success text-capitalize">' . $role->name . '</span>';
                })->implode(' ');
                return $roleName;
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
                if (auth()->user()->can('edit-users')) {
                    $action = $action . ' <a href="' . route('users.edit', $user->id) . '" class="btn btn-info btn-sm btn-x-sm"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (auth()->user()->can('delete-users')) {
                    $action = $action . ' <button type="button" data-remote="' . route('users.delete', $user->id) . '" class="btn btn-danger btn-sm btn-x-sm" id="delete"><i class="far fa-trash-alt"></i></button>';
                }
                if (auth()->user()->can('change-password-users')) {
                    $action = $action . ' <a href="' . route('users.password', $user->id) . '" class="btn btn-warning btn-sm btn-x-sm"><i class="fas fa-sync-alt"></i></a>';
                }
                return $action;
            })
            ->orderColumn('created_at', '-created_at')
            ->orderByNullsLast()
            ->rawColumns(['name', 'roles', 'action'])
            ->make(true);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $roles = $this->role->all();
        return view('pages.assessments.users.create', compact('roles'));
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $createdObject = parent::store($request);
            if ($createdObject instanceof $this->model) {
                if (isset($request->roles)) {
                    $roles = $this->role->getByArray('id', $request->roles);
                    $createdObject->assignRole($roles);
                } else {
                    DB::rollBack();
                    return error();
                }
                DB::commit();
                toastSuccess('Record has been saved successfully!');
                return redirect()->route('users');
            }
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
        return view('pages.assessments.users.edit', compact('user', 'roles'));
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
            $attributes = $request->all();
            $this->validate($request, $this->model->rulesToUpdate($id));
            DB::beginTransaction();
            $updatedObject = $this->service->updateById($id, $attributes);
            if ($updatedObject) {
                if (isset($request->roles)) {
                    $roles = $this->role->getByArray('id', $request->roles);
                    $updatedObject->syncRoles($roles);
                } else {
                    $updatedObject->syncRoles('');
                }
                DB::commit();
                toastSuccess('Record has been updated successfully!');
                return redirect()->route('users');
            }
            DB::rollBack();
            return error('Record not create');
        }
        DB::rollBack();
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

    public function profile()
    {
        return view('pages.profile.index');
    }

    public function updateInfo(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:3'
            ]);
            $updatedObject = $this->service->updateById($id, $request->all());
            if ($updatedObject) {
                return success_update($updatedObject);
            }
            return error('Something has been wrong');
        } catch (ValidationException $validation) {
            return error_validate($validation->errors());
        }
    }

    public function changePassword(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'old_password' => 'required|min:8',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required'
            ]);
            $auth = $this->service->getById($id);
            if ((Auth::user()->getAuthIdentifier()) == ($auth->id)) {
                if (Hash::check($request->old_password, $auth->password)) {
                    $this->service->changePassword($auth, $request->password);
                    return success_update($auth);
                } else {
                    return error_validate(['old_password' => 'Record not match']);
                }
            } else {
                return error('Something has been wrong');
            }
        } catch (ValidationException $validation) {
            return error_validate($validation->errors());
        }
    }

    public function password($id)
    {
        $user = $this->service->getById($id);
        return view('pages.assessments.users.editPassword', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);
        $auth = $this->service->getById($id);
        if (!$auth) {
            return $this->error();
        }
        $this->service->changePassword($auth, $request->password);
        toastSuccess('Password has been updated');
        return redirect()->route('users');
    }

    public function changeAvatar(Request $request, $id)
    {
        DB::beginTransaction();
        $auth = $this->service->getById($id);
        if ((Auth::user()->getAuthIdentifier()) == ($auth->id)) {
            $avatar = $request->input('avatar');
            $avatar = str_replace('data:image/jpeg;base64,', '', $avatar);
            $avatar = str_replace(' ', '+', $avatar);
            $name = time() . '.' . 'png';
            $folder = '/storage/users';
            $avatarName = $folder . '/' . $name;
            if (!File::exists(public_path($folder))) {
                File::makeDirectory(public_path($folder), 0777, true, true);
            }
            if ($auth->avatar === 'storage/users/default.png') {
                File::put(public_path($folder) . '/' . $name, base64_decode($avatar));
            } else {
                File::put(public_path($folder) . '/' . $name, base64_decode($avatar));
                $authAvatar = public_path($auth->avatar);
                if (File::exists($authAvatar)) {
                    File::delete($authAvatar);
                }
            }
            $this->service->changeAvatar($auth, $avatarName);
            DB::commit();
            return success_update($auth);
        } else {
            DB::rollBack();
            return error('Something has been wrong');
        }
    }
}
