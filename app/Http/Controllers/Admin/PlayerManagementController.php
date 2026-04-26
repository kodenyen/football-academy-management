<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;

class PlayerManagementController extends Controller
{
    public function index()
    {
        $players = Player::with('user')->paginate(10);
        return view('admin.players.index', compact('players'));
    }

    public function show(Player $player)
    {
        return view('admin.players.show', compact('player'));
    }

    public function destroy(Player $player)
    {
        $user = $player->user;
        $player->delete();
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.players.index')->with('success', 'Player and associated user account deleted successfully.');
    }
}
