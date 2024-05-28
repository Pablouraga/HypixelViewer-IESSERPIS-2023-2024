<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\CountValidator\AtMost;

class PlayerController extends Controller
{
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

        session(['username' => $data['data']['player']['username']]);
        session(['uuid' => $data['data']['player']['id']]);


        //Find if the logged user has the player as favourite
        // if (Auth::check()) {
        //     $userController = new UserController();
        //     $user = User::find(Auth::user()->id);
        //     $favourites = $userController->isFavourited($user, session('uuid'));
        //     return view('player.generalView', ['user' => $data, 'favourites' => $favourites]);
        // }

        //Favourite list
        // if (Auth::check()) {
        //     $userController = new UserController();
        //     $user = User::find(Auth::user()->id);
        //     $favourites = $userController->favouriteList($user);
        //     return view('player.generalView', ['user' => $data, 'favourites' => $favourites]);
        // }

        //Call to show method
        return $this->show($data);
    }
    
    public function show(Array $player){
        return view('player.generalView', ['player' => $player]);
    }

    public function findFavourites(User $user)
    {
        $favourites = Player::where('user_who_adds', $user->id)->get();
        return $favourites;
    }

    public function serverStats()
    {
        $url = "https://api.hypixel.net/v2/player?key=" . env('HYPIXEL_API_KEY') . "&uuid=" . session('uuid');
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return view('player.serverStats', ['serverStats' => $data['player']]);
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

        return view('player.auctionHistory', ['bidsData' => $bidsDataFinal, 'auctionsData' => $auctionsDataFinal]);
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
        return view('player.skyblockStats', ['skyblockStats' => $data]);
    }

    public function guildDetails()
    {
        // https://api.hypixel.net/v2/guild?key=ba3ad15e-95e0-4134-8ced-5c3b76516167&player=c4319a64-486d-4efb-9803-abde4cf40ffd
        $url = "https://api.hypixel.net/v2/guild?key=" . env('HYPIXEL_API_KEY') . '&player=' . session('uuid');
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return view('player.guildDetails', ['guildDetails' => $data]);
    }

    // public function toggleFavourite()
    // {
    //     $user = User::find(auth()->user()->id);
    //     $player = Player::where('username', session('username'))->first();

    //     if (!$player) {
    //         $player = new Player();
    //         $player->username = session('username');
    //         $player->uuid = session('uuid');
    //         $player->save();
    //     }

    //     //Agregar o eliminar a favoritos
    //     $user->favourites()->toggle($player->id);

    //     // if ($user->favourites()->where('user_added', $player->uuid)->exists()) {
    //     //     $user->favourites()->detach($player->id);
    //     // } else {
    //     //     $user->favourites()->attach($player->id);
    //     // }

    //     //Redirigir a la misma pagina
    //     return redirect()->route('generalView');
    // }
}
