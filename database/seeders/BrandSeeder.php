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
       Brands::create(['brand_name'=>'Samsung','brand_code'=>'brc-sgT','status'=>'1']);
       Brands::create(['brand_name'=>'Apple','brand_code'=>'brc-aeT','status'=>'1']);
       Brands::create(['brand_name'=>'Oppo','brand_code'=>'brc-ooT','status'=>'1']);
       
    }
}
