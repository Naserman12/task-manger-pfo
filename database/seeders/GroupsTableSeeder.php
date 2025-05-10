<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\User;
class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $groups = [
            ['name' => 'مجموعة التطوير', 'leader_id' => 1],
            ['name' => 'مجموعة التصميم', 'leader_id' =>  3],
            ['name' => 'مجموعة التسويق', 'leader_id' => 5],
            ['name' => 'مجموعة المناقشات العامة', 'leader_id' => 4]
        ];

        foreach($groups as $group){
            Group::create($group);
        }

        // إضافة اعضاء للمجموعة
        $this->addMembersToGroups();
    }
    protected function addMembersToGroups(){
        $groups = Group::all();
        $users = User::where('role', 'member')->get();

        foreach ($groups as $group ) {
            $randomMembers= $users->random(rand(2,6))->pluck('id');
            $group->members()->attach($randomMembers, [
                'role' =>'member',
                'status' => 'accepted',
                'invited_by' => $group->leader_id,
                'invited_at' => now(),
                'responded_at' => now(),
                'joined_at' => now()
            ]);

            // نائيب المشرف
            if ($subLeader = $users->whereNotIn('id', $randomMembers)->first()) {
                $group->members()->attach($subLeader->id, [
                    'role' => 'sub_leader',
                    'status' => 'accepted',
                    'invited_by' => $group->leader_id,
                    'invited_at' => now()->subDays(2),
                    'responded_at' => now()->subDay(1),
                    'joined_at' => now()

                ]);
            }
        }
    }
}
