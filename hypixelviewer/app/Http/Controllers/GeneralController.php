<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function serverStats()
    {
        $url = "https://api.hypixel.net/v2/player?key=" . env('HYPIXEL_API_KEY') . "&uuid=" . session('uuid');
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return view('serverStats', ['serverStats' => $data['player']]);
    }

    public function auctionHistory()
    {
        $url = "https://api.hypixel.net/status?key=" . env('HYPIXEL_API_KEY');
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return view('auctionHistory', ['auctionData' => $data]);
    }

    public function skyblockStats()
    {
        // https://api.hypixel.net/v2/skyblock/profiles?key=ba3ad15e-95e0-4134-8ced-5c3b76516167&uuid=b98743bf-b923-44e2-9dcc-4f1a8b25e8e5
        $url = "https://api.hypixel.net/v2/skyblock/profiles?key=" . env('HYPIXEL_API_KEY') . '&uuid=' . session('uuid');
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        foreach ($data['profiles'] as $item) {
            if ($item['selected']) {
                $data = $item;
            }
        }
        return view('skyblockStats', ['stats' => $data]);
    }

    public function guildDetails()
    {
        $url = "https://api.hypixel.net/status?key=" . env('HYPIXEL_API_KEY');
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return view('stats', ['stats' => $data]);
    }
}
