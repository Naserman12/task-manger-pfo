<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function tasks(){
        return $this->belongsToMany(Task::class)->withTimestamps();
    }
    public function members(){
        return $this->belongsToMany(User::class)
                    ->withPivot('role', 'assigned_at')
                    ->withTimestamps();
    }
    public function pendingInvitations(){
        return $this->hasMany(Invitation::class)->where('status', 'pending');
    }
}
