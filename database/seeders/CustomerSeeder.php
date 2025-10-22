<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create(['customer_name'=>"seed1",'customer_email'=>"seed1@example.com",'customer_phone'=>'01284573234']);
    Customer::create(['customer_name'=>"seed2",'customer_phone'=>'01484573234']);
     Customer::create(['customer_name'=>"seed3",'customer_phone'=>'01484573235']);
     Customer::create(['customer_name'=>"seed4",'customer_phone'=>'01486573235']);
     Customer::create(['customer_name'=>"seed5",'customer_phone'=>'01487573235']);

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    }    
}
