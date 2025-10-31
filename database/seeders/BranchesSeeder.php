<?php

namespace Database\Seeders;

use App\Models\Branches;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branches::create(['name'=>'Mohammadpur Branch','location'=>"u-52,Noorjahan Road,Mohammadpur"]);
        Branches::create(['name'=>'Shantinagar Branch','location'=>"1/2,Bhasahni Goli,Shantinagar"]);
        Branches::create(['name'=>'Banani Branch','location'=>"1/2,Banani Goli,Banani"]);
    }
}
 