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

    public function favourites()
    {
        return $this->belongsToMany(User::class, 'player_user')->withTimestamps();
    }
}
