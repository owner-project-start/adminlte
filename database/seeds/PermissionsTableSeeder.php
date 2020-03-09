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

        foreach (Models() as $model) {
            $actions = [
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
                ],
                [
                    'name' => $model . '-managements'
                ]
            ];
            foreach ($actions as $action) {
                Permission::create([
                    'name' => $action['name'],
                ]);
            }
        }
        $permissions = [
            [
                'name' => 'change-password-users'
            ],
            [
                'name' => 'backend'
            ],
            [
                'name' => 'access-managements'
            ]
        ];
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name']
            ]);
        }
    }
}
