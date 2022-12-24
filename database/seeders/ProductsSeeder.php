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
            'code_product' => 'PDK-'.date('Ymd').rand(1111,9999),
            'name' => 'Product 1',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-'.date('Ymd').rand(1111,9999),
            'name' => 'Product 2',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 0,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-'.date('Ymd').rand(1111,9999),
            'name' => 'Product 3',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-'.date('Ymd').rand(1111,9999),
            'name' => 'Product 4',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 0,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-'.date('Ymd').rand(1111,9999),
            'name' => 'Product 5',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-'.date('Ymd').rand(1111,9999),
            'name' => 'Product 6',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-'.date('Ymd').rand(1111,9999),
            'name' => 'Product 7',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-'.date('Ymd').rand(1111,9999),
            'name' => 'Product 8 ',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-'.date('Ymd').rand(1111,9999),
            'name' => 'Product 9 ',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
        Products::create([    
            'code_product' => 'PDK-'.date('Ymd').rand(1111,9999),
            'name' => 'Product 10',
            'category_id' => 1,
            'image' => 'product/default.png',
            'stok'  => 20,
            'price_buy' => '2900',
            'price_sell' => '3500',
            'desc'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, rem.',
        ]);
    }
}
