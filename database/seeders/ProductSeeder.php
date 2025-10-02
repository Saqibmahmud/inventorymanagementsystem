<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::create(['product_name'=>'Product A','code'=>'PR-A','brands_id'=>'1','product_categories_id'=>'1','description'=>'gpood product it is ,best']);
            Products::create(['product_name'=>'Product B','code'=>'PR-B','brands_id'=>'1','product_categories_id'=>'1','description'=>'gpood product it is wow best']);

    }
}
