<?php

namespace App\Models;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Model;
class Group extends Model
{
    public function notification(){
        return $this->hasManyThrough(
        \Illuminate\Notifications\DatabaseNotification::class,
        \App\Models\GroupUser::class,
        'group_id',
        'notification_id',
        'id',
        'user_id'
        );
    }
    protected $fillable = ['name', 'leader_id'];
    public function tasks(){
        return $this->belongsToMany(Task::class)->withTimestamps();
    }
    public function members(){
        return $this->belongsToMany(User::class, 'group_user')
                    ->withPivot('role', 'status', 'invited_by', 'token', 'invited_at','responded_at', 'joined_at')
                    ->withTimestamps();
    }
    
    function leader(){
        return $this->belongsTo(User::class, 'leader_id');
    }
    public function pendingInvitations(){
        return $this->hasMany(Invitation::class)->where('status', 'pending');
    }
    public function getRouteKeyName(){
       return 'id';
  }
}
