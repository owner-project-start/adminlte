<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\ParentController;
use App\Services\Roles\RoleService;
use App\Services\Users\UserService;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends ParentController
{
    public function __construct(User $user, UserService $userService)
    {
        $this->model = $user;
        $this->service = $userService;
    }

    public function index()
    {
        // return to view index page of users
        return view('pages.users.index');
    }

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
            ->addColumn('action', function ($user) {
                $action = "";
                $action = $action . ' <a href="' . route('users.edit', $user->id) . '" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>';
                $action = $action . ' <a href="' . route('users.edit', $user->id) . '" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $action = $action . ' <a href="' . route('users.edit', $user->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-sync-alt"></i></a>';
                $action = $action . ' <button type="button" data-remote="' . route('users.delete', $user->id) . '" class="btn btn-danger btn-sm" id="delete"><i class="far fa-trash-alt"></i></button>';
                return $action;
            })
            ->rawColumns(['name', 'roles', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
        // find user from service
        $user = $this->service->getById($id);
        return view('pages.users.edit', compact('user'));
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
