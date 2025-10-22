<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create(['supplier_name'=>"Supplier1",'contact_name'=>"Contact1",'phone'=>'01234567890','email'=>'suppler1@example.com']);
        Supplier::create(['supplier_name'=>"Supplier2",'contact_name'=>"Contact2",'phone'=>'01434567890','email'=>'suppler2@example.com']);
        Supplier::create(['supplier_name'=>"Supplier3",'contact_name'=>"Contact3",'phone'=>'01534567890','email'=>'suppler3@example.com']);
        Supplier::create(['supplier_name'=>"Supplier4",'contact_name'=>"Contact4",'phone'=>'01634567890','email'=>'suppler4@example.com']);
        Supplier::create(['supplier_name'=>"Supplier5",'contact_name'=>"Contact5",'phone'=>'01734567890','email'=>'suppler5@example.com']);

    }
}
