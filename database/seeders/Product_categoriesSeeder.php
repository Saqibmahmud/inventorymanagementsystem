<?php

namespace Database\Seeders;

use App\Models\Product_Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Product_categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product_Categories::create(['product_category_name'=>'Category A','product_category_code'=>'C-A','status'=>'active']);
    }
}
