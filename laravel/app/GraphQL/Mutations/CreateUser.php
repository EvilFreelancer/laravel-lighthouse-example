<?php

namespace App\GraphQL\Mutations;

use App\User;

class CreateUser
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user           = new User();
        $user->name     = $args['name'];
        $user->email    = $args['email'];
        $user->password = \Hash::make($args['email']);
        $user->save();

        return $user;
    }
}
