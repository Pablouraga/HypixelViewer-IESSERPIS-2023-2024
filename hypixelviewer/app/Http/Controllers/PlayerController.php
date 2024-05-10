<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //Api request to https://playerdb.co/api/player/minecraft/$ID

        try {
            $url = "https://playerdb.co/api/player/minecraft/" . $request->input('username');
            $json = file_get_contents($url);
            $data = json_decode($json, true);
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Player not found');
        }
        session(['username' => $data['data']['player']['username']]);
        session(['uuid' => $data['data']['player']['id']]);
        return view('player.show', ['user' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
