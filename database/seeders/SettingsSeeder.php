<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
        'name' => 'Laravel x Livewire',
        'owner_name' => 'Bagas Arya Pradipta',
        'address' => 'Kota Depok',
        'number_phone' => '08128571',
        'image' => 'logo/default.png'
        ]);
    }
}
