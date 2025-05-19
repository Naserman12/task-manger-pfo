<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
            $this->call([
                UserSeeder1::class,
              GroupsTableSeeder::class,
                UserSeeder::class,
            GroupSeeder::class,
            ProjectSeeder::class,
        ]);
        // User::factory(10)->create();

      
    }
}
