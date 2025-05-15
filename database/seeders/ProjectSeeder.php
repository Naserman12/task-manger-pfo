<?php
// database/seeders/ProjectSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;
use App\Models\Group;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $groups = Group::all();
        $users = User::all();

        for ($i = 1; $i <= 10; $i++) {
            Project::create([
                'name' => "مشروع رقم $i",
                'description' => "وصف لمشروع رقم $i",
                'start_date' => now()->subDays(rand(0, 20)),
                'end_date' => now()->addDays(rand(3, 20)),
                'group_id' => $groups->random()->id,
                'created_by' => $users->random()->id,
                'status' => collect(['pending', 'in_progress', 'completed', 'cancelled'])->random(),
                'priority' => collect(['low', 'medium', 'high'])->random(),
            ]);
        }
    }
}
