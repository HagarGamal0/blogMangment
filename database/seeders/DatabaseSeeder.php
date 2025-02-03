<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Spatie\Permission\Models\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
           // Create roles
           $adminRole = Role::firstOrCreate(['name' => 'Admin']);
           $authorRole = Role::firstOrCreate(['name' => 'Author']);

           // Create Admin
           $admin = User::factory()->create([
               'name' => 'Admin User',
               'email' => 'admin@example.com',
               'password' => bcrypt('password'),
           ]);
           $admin->assignRole($adminRole);

           // Create Authors
           User::factory(5)->create()->each(function ($user) use ($authorRole) {
               $user->assignRole($authorRole);
           });

           // Create Dummy Posts
           Post::factory(20)->create();
       }
}
