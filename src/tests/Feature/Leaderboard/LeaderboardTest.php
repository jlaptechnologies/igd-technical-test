<?php

namespace Leaderboard;

use App\Models\Game;
use App\Models\GameScore;
use App\Models\Member;
use App\Models\MemberDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaderboardTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        \cache()->clear();
    }

    /**
     * // Currently broken due to a cache driver conflict between HTTP kernel and console kernel
     * @test
     * @return void
     */
    public function canViewMemberLeaderBoard()
    {
        $this->markTestIncomplete('Cache driver functionality issue between HTTP and Console kernel.');
        Member::factory(5)
            ->create()
            ->each(function(Member $member) {
                MemberDetail::factory()->make([
                    'member_id' => $member->{$member->getKeyName()},
                    'email' => \strtolower($member->firstName.'.'.$member->lastName.'@'.\fake()->freeEmailDomain),
                ])->save();
                $member->save();
            });

        $members = Member::all(['id']);

        Game::factory($members->count() * 2)
            ->make()
            ->each(function(Game $game)use($members) {

                $game->save();

                $totalPlayers = \mt_rand(2,4); // "at least" 2 players

                $players = $members->random($totalPlayers);

                $players->each(function (Member $member) use($game) {
                    GameScore::factory()->createOne([
                        'gameId' => $game->{$game->getKeyName()},
                        'memberId' => $member->{$member->getKeyName()},
                        'playerScore' => \mt_rand(248, 589),
                    ])->save();
                });
            });

        $response = $this->get('/');

        $response->assertOk();

        $response->assertDontSee('Currently no data exist in the database regarding members or games played.');
    }
}
