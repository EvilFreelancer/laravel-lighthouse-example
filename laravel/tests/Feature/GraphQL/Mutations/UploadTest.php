<?php

namespace Tests\Feature\GraphQL\Mutations;

use App\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadTest extends TestCase
{
    /**
     * @var \App\User
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user->api_token,
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpload()
    {
        $response = $this->multipartGraphQL(
            [
                'operations' => /** @lang JSON */
                    '
                        {
                            "query": "mutation Upload($file: Upload!) { upload(file: $file) { id, url} }",
                            "variables": {
                                "file": null
                            }
                        }
                    ',
                'map'        => /** @lang JSON */
                    '
                        {
                            "0": ["variables.file"]
                        }
                    ',
            ],
            [
                '0' => UploadedFile::fake()->create('image.jpg', 500),
            ]
        );

        $upload = $response->json('data.upload');

        $this->assertNotEmpty($upload['id']);
        $this->assertNotEmpty($upload['url']);
    }
}
