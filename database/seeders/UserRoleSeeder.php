<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'login_access' => 'Admin',
            'desc' => 'Admin Access',
        ]);

        UserRole::create([
            'login_access' => 'Sub-Admin',
            'desc' => 'Sub Admin Access',
        ]);

        UserRole::create([
            'login_access' => 'User',
            'desc' => 'User Access',
        ]);
    }
}
