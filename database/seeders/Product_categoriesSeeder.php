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
        
         Product_Categories::create(['product_category_name'=>'Category c','product_category_code'=>'C-c','status'=>'active']);
           Product_Categories::create(['product_category_name'=>'Category d','product_category_code'=>'C-d','status'=>'inactive']);
             Product_Categories::create(['product_category_name'=>'Category E','product_category_code'=>'C-e','status'=>'active']);
               Product_Categories::create(['product_category_name'=>'Category F','product_category_code'=>'C-f','status'=>'active']);
         
    }
}
