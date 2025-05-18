<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
     protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'group_id',
        'created_by',
          'status',
        'priority',
    ];
    public function group()
{
    return $this->belongsTo(Group::class);
}

public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}
public function tasks()
{
    return $this->hasMany(Task::class);
}


}
