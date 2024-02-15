<?php

namespace Database\Seeders;

use App\Models\Game;
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
                $playerOne = $members->random()->id;
                $playerTwo = $members->random()->id;

                // Keep going until random selects a different id
                while($playerTwo === $playerOne) {
                    $playerTwo = $members->random()->id;
                }

                $game->playerOneMemberId = $playerOne;
                $game->playerTwoMemberId = $playerTwo;

                $game->save();
            });
    }
}
