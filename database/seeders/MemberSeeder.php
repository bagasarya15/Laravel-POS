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
            'code_member' => 'MBR-'.date('Ymd').rand(1111,9999),
            'name' => 'Customer Umum',
            'member_status' => 'Non-Member'
        ]);
        Members::create([
            'code_member' => 'MBR-'.date('Ymd').rand(1111,9999),
            'name' => 'Bagas Arya',
            'member_status' => 'Member'
        ]);
        Members::create([
            'code_member' => 'MBR-'.date('Ymd').rand(1111,9999),
            'name' => 'Oki',
            'member_status' => 'Member'
        ]);
        Members::create([
            'code_member' => 'MBR-'.date('Ymd').rand(1111,9999),
            'name' => 'Rafly',
            'member_status' => 'Non-Member'
        ]);
        Members::create([
            'code_member' => 'MBR-'.date('Ymd').rand(1111,9999),
            'name' => 'Joestars',
            'member_status' => 'Non-Member'
        ]);
    }
}
