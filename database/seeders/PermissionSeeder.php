<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //brand
        Permission::create(['name'=>'Edit-Brand']);
        Permission::create(['name'=>'Delete-Brand']);
        Permission::create(['name'=>'View-Brand']);

          //category
                  Permission::create(['name' => 'View-Category']);
        Permission::create(['name' => 'Create-Category']);
        Permission::create(['name' => 'Edit-Category']);
        Permission::create(['name' => 'Delete-Category']);

        // Role
        Permission::create(['name' => 'View-Role']);
        Permission::create(['name' => 'Create-Role']);
        Permission::create(['name' => 'Edit-Role']);
        Permission::create(['name' => 'Delete-Role']);

        // Product
        Permission::create(['name' => 'View-Product']);
        Permission::create(['name' => 'Create-Product']);
        Permission::create(['name' => 'Edit-Product']);
        Permission::create(['name' => 'Delete-Product']);

        // Supplier
        Permission::create(['name' => 'View-Supplier']);
        Permission::create(['name' => 'Create-Supplier']);
        Permission::create(['name' => 'Edit-Supplier']);
        Permission::create(['name' => 'Delete-Supplier']);

        // Purchase
        Permission::create(['name' => 'View-Purchase']);
        Permission::create(['name' => 'Create-Purchase']);
        Permission::create(['name' => 'Edit-Purchase']);
        Permission::create(['name' => 'Delete-Purchase']);

        // Sale
        Permission::create(['name' => 'View-Sale']);
        Permission::create(['name' => 'Create-Sale']);
        Permission::create(['name' => 'Edit-Sale']);
        Permission::create(['name' => 'Delete-Sale']);

        // Customer
        Permission::create(['name' => 'View-Customer']);
        Permission::create(['name' => 'Create-Customer']);
        Permission::create(['name' => 'Edit-Customer']);
        Permission::create(['name' => 'Delete-Customer']);

        // User
        Permission::create(['name' => 'View-User']);
        Permission::create(['name' => 'Create-User']);
        Permission::create(['name' => 'Edit-User']);
        Permission::create(['name' => 'Delete-User']);
        
    }
}
