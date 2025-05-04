<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function groups(){
        return $this->belongsToMany(Group::class)->withTimestamps();
    }
}
