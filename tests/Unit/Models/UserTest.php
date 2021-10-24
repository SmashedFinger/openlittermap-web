<?php

namespace Tests\Unit\Models;

use App\Models\Teams\Team;
use App\Models\User\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_a_user_has_an_is_trusted_attribute()
    {
        $team = Team::factory()->create(['is_trusted' => true]);
        $user = User::factory()->create(['verification_required' => true]);

        $this->assertFalse($user->is_trusted);

        $user->teams()->attach($team);
        $user->active_team = $team->id;
        $user->save();

        $this->assertTrue($user->fresh()->is_trusted);
    }
}
