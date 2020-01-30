<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory(User::class, 100)->create();
        if (Schema::hasTable('users')) {
            $users = [
                [
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make(12345678),
                ],
                [
                    'name' => 'creator',
                    'email' => 'creator@admin.com',
                    'password' => Hash::make(12345678),
                ],
                [
                    'name' => 'editor',
                    'email' => 'editor@admin.com',
                    'password' => Hash::make(12345678),
                ],
                [
                    'name' => 'destroyer',
                    'email' => 'deleter@admin.com',
                    'password' => Hash::make(12345678),
                ]
            ];

            foreach ($users as $user){
                User::create($user);
            }
        }
    }
}
