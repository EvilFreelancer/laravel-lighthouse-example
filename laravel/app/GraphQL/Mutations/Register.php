<?php

namespace App\GraphQL\Mutations;

use App\User;
use GraphQL\Error\Error;

class Register
{
    /**
     * @param null                 $_
     * @param array<string, mixed> $args
     *
     * @return \App\User
     * @throws \GraphQL\Error\Error
     */
    public function __invoke($_, array $args)
    {
        $user           = new User();
        $user->name     = $args['name'];
        $user->email    = $args['email'];
        $user->password = \Hash::make($args['password']);
        $user->save();

        return $user;
    }
}
