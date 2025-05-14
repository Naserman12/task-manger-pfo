<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    use Notifiable;
    protected $table = 'notifications';

    protected $fillable = ['type', 'notifiable_type', 'notifiable_id', 'data'];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];
}
