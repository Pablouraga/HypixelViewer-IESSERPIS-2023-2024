<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();

        return view('backend.ticketsIndex', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        //
    }

    public function destroy(Ticket $ticket)
    {
        $ticket = Ticket::findorFail($ticket->id);
        $ticket->delete();
        return redirect()->route('tickets.index');
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(TicketRequest $request)
    {

        $ticket = new Ticket();
        $ticket->subject = $request->subject;
        $ticket->text = $request->text;
        if (Auth::check()) {
            $ticket->sender_email = Auth::user()->email;
        } else {
            $ticket->sender_email = $request->sender_email;
        }
        $ticket->status = 'NotRead';
        $ticket->save();

        return redirect()->route('tickets.index');
    }
}
