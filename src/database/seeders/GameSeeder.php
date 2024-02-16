<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GameScore;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::all(['id']);

        Game::factory($members->count() * 25)
            ->make()
            ->each(function(Game $game)use($members) {

                $game->save();

                $totalPlayers = \mt_rand(2,4); // noticed the "at least" in bold

                $players = $members->random($totalPlayers);

                $players->each(function (Member $member) use($game) {
                    GameScore::create([
                        'gameId' => $game->{$game->getKeyName()},
                        'memberId' => $member->{$member->getKeyName()},
                        'playerScore' => \mt_rand(248, 589),
                    ]);
                });
            });
    }
}
