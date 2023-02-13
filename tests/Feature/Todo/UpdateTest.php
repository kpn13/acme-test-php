<?php

namespace Tests\Feature\Todo;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    /**
     * @test
     */
    public function update_should_return_successful_response()
    {
        Http::fake([
            '*' => Http::sequence()
                    ->push([
                        'checked' => false,
                        'createdAt' => 1675207417659,
                        'text' => 'Test todo',
                        'id' => '4a0d30b0-a1be-11ed-a408-4d2bbe28719a',
                        'updatedAt' => 1675330369104,
                    ])
                    ->push([[
                        'checked' => false,
                        'createdAt' => 1675207417659,
                        'text' => 'Test todo',
                        'id' => '4a0d30b0-a1be-11ed-a408-4d2bbe28719a',
                        'updatedAt' => 1675330369104,
                    ]]),
        ]);

        $response = $this->followingRedirects()->put('/todos/4a0d30b0-a1be-11ed-a408-4d2bbe28719a', [
            'text' => 'Test todo',
            'checked' => true,
        ]);

        $response->assertStatus(200);
    }
}
