<?php

namespace Tests\Feature\GraphQL\Mutations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $name     = 'dummy';
        $email    = 'dummy@example.com';
        $password = 'test_pass';

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation {
              register(input:{name:"' . $name . '",email:"'.$email.'",password:"'.$password.'",password_confirmation:"'.$password.'"}) {
                id
                name
                email
                api_token
                created_at
              }
            }
        ');

        $register = $response->json('data.register');

        $this->assertEquals($register['email'], $email);
        $this->assertEquals($register['name'], $name);
    }
}
