<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Notification;

class UpdateNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update notification to add message field';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    //     $notifications = Notification::all();
    //     foreach ($notifications as $notification ) {
    //         $data = $notification->data;

    //         if (isset($data['type' && $data['type'] === 'group_invitation'])) {
    //            $data['message'] = "تمت دعوتك للانضمام إلى مجموعة : {$data['groupName']} بدور {$data['role']}" ;
    //            $notification->data;
    //            $notification->save();
    //         }
    //     }
    //     $this->info('Notification Updated Successfully');
    }
}
