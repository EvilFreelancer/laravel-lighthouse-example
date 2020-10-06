<?php

namespace App\Observers;

use App\User;
use Carbon\Carbon;

class UserObserver
{
    /**
     * @param \App\User $user
     */
    public function created(User $user): void
    {
        $token = \Str::random(80);
        $hash  = hash('sha256', $token);

        $user->api_token  = $token;
        $user->expired_at = Carbon::now()->addDays(30);
        $user->save();
    }
}
