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
        $validator = \Validator::make($args, [
            'name'                  => 'required|min:1',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            throw new Error('Unable to register: ' . json_encode($validator->errors()));
        }

        $user           = new User();
        $user->name     = $args['name'];
        $user->email    = $args['email'];
        $user->password = \Hash::make($args['password']);
        $user->save();

        return $user;
    }
}
