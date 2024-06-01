<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TextController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $inbox = Text::where('receiver', $user->id)->get();
        $sent = Text::where('sender', $user->id)->get();
        return view('users.messages.index', ['inbox' => $inbox, 'sent' => $sent]);
    }
}
