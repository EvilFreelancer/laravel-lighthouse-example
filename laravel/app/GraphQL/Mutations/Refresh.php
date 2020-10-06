<?php

namespace App\GraphQL\Mutations;

use Carbon\Carbon;

class Refresh
{
    /**
     * @param null                 $_
     * @param array<string, mixed> $args
     */
    public function __invoke($_, array $args)
    {
        /** @var \App\User $user */
        $user = \Auth::guard()->user();

        $user->api_token  = \Str::random(80);
        $user->expired_at = Carbon::now()->addDays(30);
        $user->save();

        return $user;
    }
}
