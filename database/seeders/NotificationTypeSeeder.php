<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotificationType;


class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    $types = [
        ['name' => 'group_invite', 'label_ar' => 'دعوة للانضمام لمجموعة', 'icon' => 'users'],
        ['name' => 'task_assigned', 'label_ar' => 'تم تعيينك لمهمة', 'icon' => 'clipboard'],
        ['name' => 'group_removed', 'label_ar' => 'تمت إزالتك من مجموعة', 'icon' => 'user-x'],
        ['name' => 'task_deleted', 'label_ar' => 'تم حذف مهمة', 'icon' => 'trash'],
        ['name' => 'welcome', 'label_ar' => 'مرحبًا بك في المنصة', 'icon' => 'smile'],
    ];

    foreach ($types as $type) {
        NotificationType::firstOrCreate(['name' => $type['name']], $type);
    }
}
}
