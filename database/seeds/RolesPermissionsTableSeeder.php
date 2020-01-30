<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\User;
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
            $admin->assignRole($roleAdmin);

//            $creator = User::where('name', 'creator')->first();
//            $roleCreator = User::where('name', 'creator')->first();
//            $creator->assignRole($roleCreator);

//            $editor = User::where('name', 'editor')->first();
//            $roleEditor = User::where('name', 'editor')->first();
//            $editor->assignRole($roleEditor);
//
//            $destroyer = User::where('name', 'destroyer')->first();
//            $roleDestroyer = User::where('name', 'destroyer')->first();
//            $destroyer->assignRole($roleDestroyer);
        }
    }
}
