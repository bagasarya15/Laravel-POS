<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsCategory;

class ProductsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductsCategory::create([
            'name' => 'Makanan',
            'desc' => 'Kategori Makanan',
        ]);
        ProductsCategory::create([
            'name' => 'Minuman',
            'desc' => 'Kategori Minuman',
        ]);
        ProductsCategory::create([
            'name' => 'Lainnya',
            'desc' => 'Kategori Lainnya',
        ]);
    }
}
