<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brands;



class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brands::create(['brand_name'=>'Brand A','brand_code'=>'BR-A','status'=>'active']);
    Brands::create(['brand_name'=>'Brand B','brand_code'=>'BR-B','status'=>'active']);
    }
}
