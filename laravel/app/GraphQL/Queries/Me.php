<?php

namespace App\GraphQL\Queries;

use App\User;
use GraphQL\Error\Error;

class Me
{
    /**
     * Return information about current user
     *
     * @param null                 $_
     * @param array<string, mixed> $args
     *
     * @return \App\User
     * @throws \GraphQL\Error\Error
     */
    public function __invoke($_, array $args): User
    {
        /** @var \App\User $user */
        $user = \Auth::guard()->user();

        if (null === $user) {
            throw new Error('User unauthenticated.');
        }

        return $user;
    }
}
