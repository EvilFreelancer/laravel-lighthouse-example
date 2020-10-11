<?php

namespace Tests\Feature\GraphQL\Queries;

use App\User;
use Tests\TestCase;

class MeTest extends TestCase
{
    /**
     * @var \App\User
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMe()
    {
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user->api_token,
        ]);

        $response = $this->graphQL(/** @lang GraphQL */'
            {
              me {
                id
                name
                email
              }
            }
        ');

        $me = $response->json('data.me');

        $this->assertEquals($me['id'], $this->user->id);
        $this->assertEquals($me['email'], $this->user->email);
        $this->assertEquals($me['name'], $this->user->name);
    }
}
