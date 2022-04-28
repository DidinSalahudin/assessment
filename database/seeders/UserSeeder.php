<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $users =  [
            [
                'fullname' => 'Administrator',
                'name'     => 'admin',
                'email'    => 'admin@admin.com',
                'password' => Hash::make('password'),
                'level'    => 'admin',
            ],
            [
                'fullname' => 'User',
                'name'     => 'user',
                'email'    => 'user@user.com',
                'password' => Hash::make('password'),
                'level'    => 'user',
            ]
        ];

        User::insert($users);
    }
}
