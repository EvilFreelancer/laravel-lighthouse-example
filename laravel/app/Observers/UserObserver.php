<?php

namespace App\Observers;

use App\User;
use Carbon\Carbon;
use Nuwave\Lighthouse\Execution\Utils\Subscription;

class UserObserver
{
    /**
     * @param \App\User $user
     */
    public function created(User $user): void
    {
        $user->api_token  = \Str::random(80);
        $user->expired_at = Carbon::now()->addDays(30);
        $user->save();

        Subscription::broadcast('userCreated', $user);
    }
}
