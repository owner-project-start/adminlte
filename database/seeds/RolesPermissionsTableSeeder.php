<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use \Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('users') || Schema::hasTable('roles')){
            $admin = User::where('name', 'admin')->first();

            $roleAdmin = Role::where('name', 'administration')->first();
            $role = Role::where('name', 'LIKE', '%roles%')->first();
            $user = Role::where('name', 'LIKE', '%users%')->first();
            $permission = Role::where('name', 'LIKE', '%permissions%')->first();

            $allPermission = Permission::get();
            $users = Permission::where('name', 'LIKE', '%users%')
                ->orWhere('name', 'LIKE', '%access-management%')
                ->orWhere('name', 'LIKE', '%users-management%')
                ->orWhere('name', 'like', '%backend%')
                ->get();
            $roles = Permission::where('name', 'LIKE', '%roles%')
                ->orWhere('name', 'LIKE', '%access-management%')
                ->orWhere('name', 'LIKE', '%roles-management%')
                ->orWhere('name', 'like', '%backend%')
                ->get();
            $permissions = Permission::where('name', 'LIKE', '%permissions%')
                ->orWhere('name', 'LIKE', '%access-management%')
                ->orWhere('name', 'LIKE', '%permissions-management%')
                ->orWhere('name', 'like', '%backend%')
                ->get();

            $roleAdmin->givePermissionTo($allPermission);
            $admin->assignRole($roleAdmin);
            $role->givePermissionTo($roles);
            $user->givePermissionTo($users);
            $permission->givePermissionTo($permissions);
        }
    }
}
