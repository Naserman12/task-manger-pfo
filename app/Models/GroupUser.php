<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupUser extends Pivot
{
    protected $table = 'group_user';
        protected $fillable = [
        'group_id',
        'user_id',
        'role',
        'status',
        'invited_by',
        'token',
        'invited_at',
        'responded_at',
        'joined_at',
    ];

    protected $casts = [
        'invited_at' => 'datetime',
        'responded_at' => 'datetime',
    ];
}
