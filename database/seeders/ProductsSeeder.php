<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsCategory;
use App\Models\Products;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create([    
            'code_product' => 'PDK-00001',
            'name' => 'Indomie 1',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00002',
            'name' => 'Indomie 2',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00003',
            'name' => 'Indomie 3',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00004',
            'name' => 'Indomie 4',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00005',
            'name' => 'Indomie 5',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00006',
            'name' => 'Indomie 6',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00007',
            'name' => 'Indomie 7',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00008',
            'name' => 'Indomie 8 ',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00009',
            'name' => 'Indomie 9 ',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00010',
            'name' => 'Indomie 10',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00011',
            'name' => 'Indomie 11',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-00012',
            'name' => 'Indomie 12',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
    }
}
