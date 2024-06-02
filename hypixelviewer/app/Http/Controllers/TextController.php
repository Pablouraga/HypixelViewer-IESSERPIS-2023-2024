<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Text;
use App\Models\User;
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

    public function create($receiverUsername)
    {
        $receiver = User::where('username', $receiverUsername)->first();
        return view('users.messages.create', ['receiver' => $receiver]);
    }

    public function store(Request $request, $receiverId)
    {
        $user = Auth::user();
        $receiver = User::find($receiverId);
        $text = new Text();
        $text->sender = $user->id;
        $text->receiver = $receiver->id;
        $text->text = $request->message;
        $text->save();
        return redirect()->route('friendList');
    }

    public function show($id)
    {
        $text = Text::find($id);
        return view('users.messages.show', ['text' => $text]);
    }
}
