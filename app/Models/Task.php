<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
     protected $fillable = [
        'title',
        'description',
        'group_id',
        'project_id',
        'assigned_to',
        'created_by',
        'status',
        'starts_at',
        'due_at',
    ];
      public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function groups(){
        return $this->belongsToMany(Group::class)->withTimestamps();
    }
      public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
     public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
