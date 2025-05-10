<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Groups\GroupForm;
use App\Models\Group;
use PHPUnit\TextUI\Configuration\GroupCollection;


// Notifications 
Route::get('/notifications', [NotificationController::class,'index'])
->name('notifications.index');
Route::get('/notifications/{notification}', [NotificationController::class,'show'])
->name('notifications.show');
Route::post('/notifications/{notification}/accept', [NotificationController::class, 'accept'])
    ->name('group.invite.accept');
Route::post('/notifications/{notification}/reject', [NotificationController::class, 'reject'])
    ->name('group.invite.reject');

// Group Member  
// Route::get('/groups/{group}/invite', [GroupMemberController::class, 'invite'])->name('groups.invite');
Route::get('/groups/{group}/respond', [GroupMemberController::class, 'respond'])->name('group-members.respond');

// Groups
Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
// Route::get('/groups/{group}', [GroupController::class, 'destroy'])->name('groups.destroy');
// Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
// Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit');
Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');
Route::get('/groups/{group}/edit', function (Group $group){
    return view('livewire/groups/edit', ['group' => $group]);
})->name('groups.edit');
Route::get('/groups/create', function (){
    return view('livewire/groups/create');
})->name('groups.create');
Route::get('/groups/{group}/delete', function (Group $group){
    return view('/livewire/groups/delete-group', ['group' => $group]);
})->name('groups.delete');

// Main Routes
// Route::view('/', 'welcome');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
