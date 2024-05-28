<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'uuid',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'players_users', 'user_added', 'user_who_adds');
    }
}
