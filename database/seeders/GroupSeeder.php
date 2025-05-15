<?php

// database/seeders/GroupSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = ['التسويق', 'التصميم', 'التطوير', 'الدعم الفني', 'شباب المستقبل', 'كن قدوة', 'همة شباب'];

        foreach ($groups as $name) {
            for ($i=1; $i < 8; $i++) { 
                Group::create(['name' => $name, 'leader_id' => $i]);
            }
        }
    }
}
