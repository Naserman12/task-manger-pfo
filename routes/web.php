<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\Home;
use App\Livewire\Groups\Index as GroupsIndex;
use App\Livewire\Tasks\Index as TasksIndex;
use App\Livewire\Users\Index as UsersIndex;
use App\Livewire\Reports\Index as ReportsIndex;
use App\Livewire\Settings\Index as SettingsIndex;
use App\Http\Controllers\Admin\GroupController as AdminGroupController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Livewire\Admin\Projects\Create;
use App\Livewire\Admin\Project\IndexProjects;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Livewire\Admin\Project\ProjectForm;
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', Home::class)->name('admin.dashboard');
    // Route::get('/groups', GroupsIndex::class)->name('admin.groups');
    Route::get('/groups/{id}/edit', [AdminGroupController::class, 'edit'])->name('admin.groups.edit'); 
    Route::delete('/groups/{id}', [AdminGroupController::class, 'destroy'])->name('admin.groups.delete'); 
    Route::get('/tasks', TasksIndex::class)->name('admin.tasks');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
    // Route::get('/reports', ReportsIndex::class)->name('admin.reports');
    Route::get('/reports', function () {
        return view('livewire.admin.reports.reportsIndex');
    })->name('admin.reports');
    Route::get('/dashboard', function () {
    return view('livewire.admin.dashboard.show-home');
    })->name('admin.dashboard');
    Route::get('/groups', function () {
    return view('livewire.admin.groups.show-admin-groups');
    })->name('admin.groups');

    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('admin.project.show');
             
    Route::get('/projects/{id}/edit', [ProjectForm::class, function($id){
        return view('livewire.admin.project.edit-project', ['id' => $id]);
    }])->name('projects.edit');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('admin.project.destroy');
    Route::get('/settings', SettingsIndex::class)->name('admin.settings');
    Route::get('/projects', IndexProjects::class)->name('admin.projects.index');
});
Route::get('/groups/editing', function(){
    view('livewire.groups.show-group-form');
});
Route::get('/test', function () {
    return view('/livewire/test-page-or');
});
Route::get('/create/test', function () {
    return view('livewire.admin.project.create-project');
});


use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\NotificationController;

use App\Livewire\Groups\GroupForm;
use App\Models\Group;
use PHPUnit\TextUI\Configuration\GroupCollection;
use App\Livewire\ShowAllNotifications;
use App\Livewire\ShowNotification;
use App\Models\Project;

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
    Route::get('/project/create',  [ProjectController::class, 'create'])->name('projects.create');
    
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
    Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit');
    Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/groups/{group}/delete', function (Group $group){
        return view('/livewire/groups/delete-group', ['group' => $group]);
    })->name('groups.delete');
    // Dashboard
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('dashboard', function () {
        return view('testDashboard');
    })->name('dashboard');

});
