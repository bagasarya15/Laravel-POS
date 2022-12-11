<?php

namespace Database\Seeders;

use App\Models\Members;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Members::create([
        'code_member' => 'MBR-00001',
        'name' => 'Customer Umum',
        'member_status' => 'Non-Member'
        ]);
    }
}
