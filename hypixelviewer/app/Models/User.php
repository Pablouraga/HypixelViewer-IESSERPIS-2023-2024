<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Faker\Provider\ar_EG\Text;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'linked_account',
        'role'
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function favourites()
    {
        return $this->belongsToMany(Player::class, 'player_user')->withTimestamps();
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friend_user', 'sender', 'receiver')->withPivot('status')->withTimestamps();
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function texts()
    {
        return $this->hasMany(Text::class, 'sender');
    }
}
