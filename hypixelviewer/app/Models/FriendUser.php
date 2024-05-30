<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendUser extends Model
{
    protected $table = 'friend_user';
    protected $fillable = [
        'sender', 'receiver', 'status',
    ];

    use HasFactory;
}
