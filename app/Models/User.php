<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];
    public function groups(){
        return $this->belongsToMany(Group::class)
                ->withPivot('role', 'assigned_at')
                ->withTimestamps();
    }
    public function leader(){
        return $this->belongsTo(User::class, 'leader_id');
    }
    public function tasks(){
        return $this->belongsToMany(Task::class)->withPivot('role')->withTimestamps();
    }
    public function isAdmin(){
        return $this->role === 'admin';
    }
    public function sendInvitations()
{
    return $this->hasMany(Invitation::class, 'inviter_id');
}
public function groupInvitations(){
    return $this->belongsToMany(Group::class ,'group_user')
                ->withPivont(['role', 'status', 'token', 'invited_by']);

}
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
