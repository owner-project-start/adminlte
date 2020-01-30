<?php

namespace App\Services\Users;

use App\Services\BaseService;
use App\User;

class UserService extends BaseService
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
