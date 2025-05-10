<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupUser extends Pivot
{
    protected $table = 'group_user';
    protected $casts = [
        'invited_at' => 'datetime',
        'responded_at' => 'datetime',
    ];
}
