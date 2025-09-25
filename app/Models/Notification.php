<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Notification extends Model
{
    use Notifiable;
    protected $table = 'notifications';

    protected $fillable = [
            'id',
            'type',
            'notifiable_id',
            'notification_type_id',
            'notiftypeiable_type', 
            'data',
            'read_at',
            'created_by'];
            public function type()
        {
            return $this->belongsTo(NotificationType::class, 'notification_type_id');
        }
        public function notifiable(): BelongsTo
        {
            return $this->morphTo();
        }
        public function sender(): BelongsTo
        {
            return $this->belongsTo(User::class, 'created_by');
        }

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];
}
