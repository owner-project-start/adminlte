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
            $creator = User::where('name', 'creator')->first();
            $editor = User::where('name', 'editor')->first();
            $destroyer = User::where('name', 'destroyer')->first();

            $roleAdmin = Role::where('name', 'administration')->first();
            $roleCreator = Role::where('name', 'creator')->first();
            $roleEditor = Role::where('name', 'editor')->first();
            $roleDestroyer = Role::where('name', 'destroyer')->first();

            $allPermission = Permission::get();
            $permissionCreate = Permission::where('name', 'LIKE', '%create%')
                ->orWhere('name', 'LIKE', '%list%')
                ->orWhere('name', 'like', '%backend%')
                ->get();
            $permissionEdit = Permission::where('name', 'LIKE', '%edit%')
                ->orWhere('name', 'LIKE', '%list%')
                ->orWhere('name', 'like', '%backend%')
                ->get();
            $permissionDelete = Permission::where('name', 'LIKE', '%delete%')
                ->orWhere('name', 'LIKE', '%list%')
                ->orWhere('name', 'like', '%backend%')
                ->get();

            $roleAdmin->givePermissionTo($allPermission);
            $admin->assignRole($roleAdmin);

            $roleCreator->givePermissionTo($permissionCreate);
            $creator->assignRole($roleCreator);

            $roleEditor->givePermissionTo($permissionEdit);
            $editor->assignRole($roleEditor);

            $roleDestroyer->givePermissionTo($permissionDelete);
            $destroyer->assignRole($roleDestroyer);
        }
    }
}
