<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        if (Schema::hasTable('roles')) {
            $roles = [
                [
                    'name' => 'administration',
                ],
                [
                    'name' => 'creator',
                ],
                [
                    'name' => 'editor',
                ],
                [
                    'name' => 'destroyer',
                ]
            ];
            foreach ($roles as $role) {
                Role::create($role);
            }
        }
    }
}
