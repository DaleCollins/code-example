<?php

namespace Tests;

use App\Models\User;

trait Helpers
{
    public function loginUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
