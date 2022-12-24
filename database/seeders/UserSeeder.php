<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'username' => 'super-admin',
        'password' => Hash::make('superadmin'), // admin
        'name' => 'Super Admin',
        'email' => 'superadmin@gmail.com',
        'role_id' => 1,
        'image' => 'avatar/default.jpg',
        'email_verified_at' => now(),
        'remember_token' => Str::random(10)
        ]);

        User::create([
        'username' => 'super-admin2',
        'password' => Hash::make('superadmin'), // admin
        'name' => 'Super Admin 2',
        'email' => 'superadmin2@gmail.com',
        'role_id' => 1,
        'image' => 'avatar/default.jpg',
        'email_verified_at' => now(),
        'remember_token' => Str::random(10)
        ]);

        User::create([
        'username' => 'admin',
        'password' => Hash::make('admin'), // admin
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'role_id' => 1,
        'image' => 'avatar/default.jpg',
        'email_verified_at' => now(),
        'remember_token' => Str::random(10)
        ]);

        User::create([
        'username' => 'sub-admin',
        'password' => Hash::make('subadmin'), // sub-admin
        'name' => 'Sub-Admin',
        'email' => 'subadmin@gmail.com',
        'role_id' => 2,
        'image' => 'avatar/default.jpg',
        'email_verified_at' => now(),
        'remember_token' => Str::random(10)
        ]);

        User::create([
        'username' => 'user',
        'password' => Hash::make('user'), // user
        'name' => 'User',
        'email' => 'user@gmail.com',
        'role_id' => 3 ,
        'image' => 'avatar/default.jpg',
        'email_verified_at' => now(),
        'remember_token' => Str::random(10)
        ]);
    }
}
