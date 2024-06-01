<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'receiver',
        'text',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver');
    }
}
