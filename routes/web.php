<?php


use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\NotificationController;

use Illuminate\Support\Facades\Route;
use App\Livewire\Groups\GroupForm;
use App\Models\Group;
use PHPUnit\TextUI\Configuration\GroupCollection;
use App\Livewire\ShowAllNotifications;
use App\Livewire\ShowNotification;


// Main Routes
Route::view('/', 'welcome-page')->name('/');

require __DIR__.'/auth.php';

// ✅ حماية الصفحات التي تتطلب تسجيل دخول
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Notifications 
    Route::get('/notifications/{id}', function ($id) {
        return view('notifications.show-notification', ['notificationId' => $id]);
    })->name('notifications.show');

    Route::get('/notifications', function () {
        return view('notifications.index');
    })->name('notifications.index');

    Route::post('/notifications/{notification}/accept', [NotificationController::class, 'accept'])
        ->name('group.invite.accept');
    Route::post('/notifications/{notification}/reject', [NotificationController::class, 'reject'])
        ->name('group.invite.reject');

    // Group Member  
    Route::get('/groups/{group}/respond', [GroupMemberController::class, 'respond'])->name('group-members.respond');

    // Groups
    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
    Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit');
    Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/groups/{group}/delete', function (Group $group){
        return view('/livewire/groups/delete-group', ['group' => $group]);
    })->name('groups.delete');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});
