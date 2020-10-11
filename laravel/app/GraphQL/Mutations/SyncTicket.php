<?php

namespace App\GraphQL\Mutations;

class SyncTicket
{
    /**
     * @param null                 $_
     * @param array<string, mixed> $args
     *
     * @return \App\User
     */
    public function __invoke($_, array $args)
    {
        /** @var \App\User $user */
        $user = \Auth::guard()->user();

        $user->tickets()->sync($args['ticket_id']);

        return $user;
    }
}
