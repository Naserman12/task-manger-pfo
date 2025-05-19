<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder1 extends Seeder
{
    
    
    public function run(): void
    {    
        // مسح البيانات السابقة
        // User::truncate();

        // Create Admin
        User::create([
                'name' => 'أبو شاكر',
                'email' => 'aboShakir@gmail.com',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
        ]);

        $leaders = [
            ['name' => 'مشرف المجموعة 1', 'username' => 'Leader1', 'email' => 'leader1@gmail.com', 'password' => Hash::make('password'), 'role' => 'team_leader'],
            ['name' => 'مشرف المجموعة 2', 'username' => 'Leader2', 'email' => 'leader2@gmail.com', 'password' => Hash::make('password'), 'role' => 'team_leader']
        ];

        foreach($leaders as $leader){
            User::create($leader);
        }

        // اعضاء عاديين 
        $members = [];

        for ($i=1; $i < 50 ; $i++) { 
            $members[] = [
                    'name' => 'عضو' .$i,
                    'username' => 'User' .$i,
                    'email' => 'member'.$i.'@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'member'
            ];
        }

        User::insert($members);
        
        // إضافة المزيد من البيانات الأعشوائية
        // User::factory()->count(22)->create();
        
    }
}
