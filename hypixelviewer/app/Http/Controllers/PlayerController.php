<?php

namespace App\Http\Controllers;

use App\Models\FriendUser;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\CountValidator\AtMost;

class PlayerController extends Controller
{
    public function playerFind(Request $request)
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
        if (Player::where('uuid', $data['data']['player']['id'])->exists()) {
            $player = Player::where('uuid', $data['data']['player']['id'])->first();
        } else {
            $player = new Player();
            $player->username = $data['data']['player']['username'];
            $player->uuid = $data['data']['player']['id'];
            $player->save();
        }

        //Call to show method
        return redirect()->route('playerShow', ['username' => $player->username]);
    }

    public function show(Player $player)
    {
        // Find if the logged user has the player as favourite
        $favourites = false;
        $player = Player::where('username', session('username'))->first();
        $linked_account = $this->hasLinkedAccount($player->username);
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $favourites = $this->isFavourited($user, $player);
        }
        // if ($linked_account != null) {
        //     return view('player.generalView', ['player' => $player, 'favourites' => $favourites, 'linked_account' => $linked_account]);
        // }
        if (Auth::check() && $linked_account != null) {
            $desiredFriend = User::where('linked_account', $player->username)->first();
            $friendshipStatus = $this->friendStatus($desiredFriend->id);
            return view('player.generalView', ['player' => $player, 'favourites' => $favourites, 'linked_account' => $linked_account, 'friendshipStatus' => $friendshipStatus]);
        }
        return view('player.generalView', ['player' => $player, 'favourites' => $favourites]);
    }

    //Check if the player is favourited by the user
    public function isFavourited(User $user, Player $player)
    {
        return $user->favourites()->where('player_id', $player->id)->exists();
    }

    public function friendStatus($user_to_add)
    {
        $loggedUser = User::where('username', Auth::user()->username)->first();
        $desiredFriend = User::where('id', $user_to_add)->first();
        $friendship = FriendUser::where(function ($query) use ($desiredFriend, $loggedUser) {
            $query->where('sender', $desiredFriend->id)
                ->where('receiver', $loggedUser->id);
        })->orWhere(function ($query) use ($desiredFriend, $loggedUser) {
            $query->where('sender', $loggedUser->id)
                ->where('receiver', $desiredFriend->id);
        })->first();
        if ($friendship) {
            return $friendship->status;
        }
    }

    //Function to add/remove a player from the user's favourites
    public function togglefavourite(Player $player)
    {
        $player = Player::where('username', session('username'))->first();
        $user = User::find(Auth::user()->id);
        if ($this->isFavourited($user, $player)) {
            $user->favourites()->detach($player->id);
        } else {
            $user->favourites()->attach($player->id);
        }
        return redirect()->route('playerShow', ['username' => $player->username]);
    }

    public function hasLinkedAccount(String $username)
    {
        return User::where('linked_account', $username)->first();
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
        //sort array by guild rank priority
        usort($data['guild']['ranks'], function ($a, $b) {
            return $a['priority'] <=> $b['priority'];
        });
        return view('player.guildDetails', ['guildDetails' => $data]);
    }
}
