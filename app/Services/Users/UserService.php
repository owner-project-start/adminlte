<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function changePassword($auth, $password)
    {
        $auth->update([
            'password' => Hash::make($password)
        ]);
        if (!$auth) {
            return false;
        }
        return $auth;
    }

    public function changeAvatar($auth, $avatar)
    {
        $auth->update([
            'avatar' => $avatar
        ]);
        if (!$auth) {
            return false;
        }
        return $auth;
    }
}
