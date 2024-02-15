<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\MemberDetail;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::factory(100)
        ->create()
        ->each(function(Member $member) {
            MemberDetail::factory()->make([
                'member_id' => $member->{$member->getKeyName()},
                'email' => \strtolower($member->firstName.'.'.$member->lastName.'@'.\fake()->freeEmailDomain),
            ])->save();
        });
    }
}
