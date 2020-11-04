<?php

namespace App\Http\Controllers;

use App\Games;
use App\Rewards;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $isUpdateReward = true;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home', ['user' => User::where('id', '=', Auth::id())->first()]);
    }

    public function getGift()
    {
        $rewards = Rewards::getActiveRewards();

        if (count($rewards) == 0) {
            return response()->json([
                'status' => true,
                'message' => 'gifts ended'
            ], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $forRandom = [];
        foreach ($rewards as $reward) {
            $forRandom[$reward->id] = $reward->weight;
        }

        $giftId = (new RandomGiftController())->random($forRandom);

        $priz = '';
        foreach ($rewards as $reward) {
            if ($reward->id == $giftId) {
                if ($reward->type == 1) {
                    $this->isUpdateReward = false;
                }
                $priz .= $reward->type == 3 ? $reward->name : $reward->name . ' ' . $reward->count;
            }
        }

        if ($this->isUpdateReward) {
            $this->updateRewards($giftId);
        }
        $this->createGame($giftId);
        $this->updateUser();

        return response()->json([
            'status' => true,
            'response' => $priz,
            'message' => ''
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function updateRewards($rewardId): void
    {
        $rewards = Rewards::where('id', $rewardId)->first();
        $rewards->can_use = 0;
        try {
            $rewards->save();
        } catch (\Exception $e) {
            Log::error('HomeController updateRewards', ['errorMessage' => $e->getMessage()]);
        }

    }

    public function updateUser(): void
    {
        $rewards = User::where('id', Auth::id())->first();
        $rewards->is_game_available = 0;
        try {
            $rewards->save();
        } catch (\Exception $e) {
            Log::error('HomeController updateRewards', ['errorMessage' => $e->getMessage()]);
        }

    }

    public function createGame($rewardId)
    {
        $game = new Games();
        $game->user_id = Auth::id();
        $game->reward_id = $rewardId;

        try {
            $game->save();
        } catch (\Exception $e) {
            Log::error('HomeController createGame', ['errorMessage' => $e->getMessage()]);
        }
    }
}
