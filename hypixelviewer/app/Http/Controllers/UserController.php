<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // Login function
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        } else {
            $error = 'Credenciales no validas';
            return redirect()->route('login')->withErrors($error);
        }
    }

    // Logout function
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    //Signup function
    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->save();

        // Authenticate the user after signup
        Auth::login($user);

        return redirect('/');
    }

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
    public function show(User $user)
    {
        $user = User::where('username', Auth::user()->username)->first();
        if ($user->linked_account != null) {
            $url = "https://playerdb.co/api/player/minecraft/" . $user->linked_account;
            $json = file_get_contents($url);
            $data = json_decode($json, true);

            $hypixelUrl = "https://api.hypixel.net/v2/player?key=" . env('HYPIXEL_API_KEY') . "&uuid=" . $data['data']['player']['raw_id'];
            $hypixelJson = file_get_contents($hypixelUrl);
            $hypixelData = json_decode($hypixelJson, true);
        }


        return view('users.show', ['user' => $user, 'data' => $data, 'hypixelData' => $hypixelData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('users.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditAccountRequest $request)
    {
        $user = Auth::user();

        $user->username = $request->username;
        if ($request->linked_account && $request->linked_account != $user->linked_account) {
            try {
                $url = "https://playerdb.co/api/player/minecraft/" . $request->linked_account;
                $json = file_get_contents($url);
                $data = json_decode($json, true);
                $user->linked_account = $data['data']['player']['username'];
            } catch (\Exception $th) {
                return redirect()->route('editProfile')->withError('linked_account', 'Invalid Minecraft username');
            }
        }

        if ($request->password && $request->password_confirmation && $request->password == $request->password_confirmation) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('showProfile')->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = User::findOrfail($user->id);
        $user->delete();
        return redirect()->route('backend.users.index')->with('success', 'User deleted successfully');
    }

    // public function toggleFavourite(User $player)
    // {
    // }
}
