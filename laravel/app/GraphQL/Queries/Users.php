<?php

namespace App\GraphQL\Queries;

use App\User;

class Users
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return User::all();
    }
}
