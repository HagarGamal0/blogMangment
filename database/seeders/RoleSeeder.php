<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'Admin']);
        $author = Role::create(['name' => 'Author']);

        Permission::create(['name' => 'manage all posts'])->assignRole($admin);
        Permission::create(['name' => 'manage own posts'])->assignRole($author);
    }
}

