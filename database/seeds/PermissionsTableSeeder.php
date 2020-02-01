<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            'users', 'roles', 'permissions'
        ];

        foreach ($models as $model) {
            $actions = [
                [
                    'name' => 'list-' . $model,
                ],
                [
                    'name' => 'create-' . $model,
                ],
                [
                    'name' => 'edit-' . $model,
                ],
                [
                    'name' => 'delete-' . $model,
                ],
                [
                    'name' => 'view-' . $model
                ]
            ];
            foreach ($actions as $action) {
                Permission::create([
                    'name' => $action['name'],
                ]);
            }
        }
        Permission::create([
            'name' => 'change-password-users'
        ]);
        Permission::create([
            'name' => 'backend'
        ]);
    }
}
