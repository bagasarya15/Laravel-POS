<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemCategories;

class SystemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SystemCategories::create([
            'name' => 'Etc',
        ]);
        SystemCategories::create([
            'name' => 'Front-End',
        ]);
        SystemCategories::create([
            'name' => 'Backend',
        ]);
    }
}
