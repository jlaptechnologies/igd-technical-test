<?php

namespace MemberDetails;

use App\Models\Game;
use App\Models\GameScore;
use App\Models\Member;
use App\Models\MemberDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberDetailsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        \cache()->clear();

        $this->setupMembersAndGames();
    }

    /**
     * @test
     * @return void
     */
    public function canUpdateMemberDetails()
    {
        $member = Member::query()->inRandomOrder()->first();

        $memberEmail = $member->memberDetail->email;

        $testEmail = 'test@test.com';

        $uri = \route('member.updateMemberDetails');

        $response = $this->put($uri, [
            'memberId' => $member->id,
            'email' => $testEmail,
        ]);

        $response->assertRedirect(\route('member.profile', ['id' => $member->id]));

        $response = $this->get(\route('member.profile', ['id' => $member->id]));

        $response
            ->assertSee($testEmail)
            ->assertDontSee($memberEmail);
    }

    /**
     * @test
     * @return void
     */
    public function invalidEmailFormat()
    {
        $member = Member::query()->inRandomOrder()->first();

        $uri = \route('member.updateMemberDetails');

        $this
            ->put($uri, [
                'memberId' => $member->id,
                'email' => 'testtest.com',
            ])
            ->assertSessionHasErrors(['email'])
            ->assertRedirect();
    }

    /**
     * @test
     * @return void
     */
    public function memberIdMissingFromRequest()
    {
        $uri = \route('member.updateMemberDetails');

        $this
            ->put($uri, [
                'email' => 'test@test.com',
            ])
            ->assertSessionHasErrors(['memberId'])
            ->assertRedirect();
    }

    private function setupMembersAndGames(): void
    {
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
    }
}
