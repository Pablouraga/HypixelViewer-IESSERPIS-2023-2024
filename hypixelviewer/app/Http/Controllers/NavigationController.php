<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function isClaimed(String $username)
    {
        if (User::where('linked_account', $username)->exists()) {
            //Devolver el usuario
            return User::where('linked_account', $username)->first();
        }
        return false;
    }
    public function findPlayer(Request $request)
    {
        //Api request to https://playerdb.co/api/player/minecraft/$ID

        try {
            $url = "https://playerdb.co/api/player/minecraft/" . $request->input('username');
            $json = file_get_contents($url);
            $data = json_decode($json, true);
        } catch (\Exception $e) {
            return redirect('/profile')->with('error', 'Player not found');
        }

        //comprobar si algun User tiene el username de la cuenta que se solicita en el campo "linked_account"
        $claimed = $this->isClaimed($data['data']['player']['username']);

        session(['username' => $data['data']['player']['username']]);
        session(['uuid' => $data['data']['player']['id']]);
        return view('generalView', ['user' => $data, 'claimed' => $claimed]);
    }

    public function serverStats()
    {
        $url = "https://api.hypixel.net/v2/player?key=" . env('HYPIXEL_API_KEY') . "&uuid=" . session('uuid');
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return view('serverStats', ['serverStats' => $data['player']]);
    }

    public function auctionHistory()
    {
        $trimmedUuid = str_replace('-', '', session('uuid'));
        //get bid history 
        $bidsUrl = "https://sky.coflnet.com/api/player/" . $trimmedUuid .  "/bids?page=";

        for ($i = 0; $i < 5; $i++) {
            $bidsJson = file_get_contents($bidsUrl . $i);
            $bidsData = json_decode($bidsJson, true);
            foreach ($bidsData as $auction) {
                $bidsDataFinal[] = $auction;
            }
        }

        //get auction history
        $auctionsUrl = "https://sky.coflnet.com/api/player/" . $trimmedUuid .  "/auctions?page=";

        for ($i = 0; $i < 5; $i++) {
            $auctionsJson = file_get_contents($auctionsUrl . $i);
            $auctionsData = json_decode($auctionsJson, true);
            foreach ($auctionsData as $auction) {
                $auctionsDataFinal[] = $auction;
            }
        }

        return view('auctionHistory', ['bidsData' => $bidsDataFinal, 'auctionsData' => $auctionsDataFinal]);
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
        return view('skyblockStats', ['skyblockStats' => $data]);
    }

    public function guildDetails()
    {
        // https://api.hypixel.net/v2/guild?key=ba3ad15e-95e0-4134-8ced-5c3b76516167&player=c4319a64-486d-4efb-9803-abde4cf40ffd
        $url = "https://api.hypixel.net/v2/guild?key=" . env('HYPIXEL_API_KEY') . '&player=' . session('uuid');
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        // if ($data['guild'] != null) {
        //     foreach ($data['guild']['members'] as $key => $player) {
        //         $url = "https://playerdb.co/api/player/minecraft/" . $player['uuid'];
        //         $json = file_get_contents($url);
        //         $data['guild']['members'][$key]['username'] = json_decode($json, true)['data']['player']['username'];
        //     }
        // }
        return view('guildDetails', ['guildDetails' => $data]);
    }
}
