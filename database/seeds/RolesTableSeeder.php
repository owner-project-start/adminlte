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
            foreach (Models() as $model) {
                $roles = [
                    [
                        'name' => $model . '-managements'
                    ],
                ];
                foreach ($roles as $role) {
                    Role::create([
                        'name' => $role['name']
                    ]);
                }
            }

            $roles = [
                [
                    'name' => 'administration',
                ]
            ];

            foreach ($roles as $role) {
                Role::create($role);
            }
        }
    }
}
