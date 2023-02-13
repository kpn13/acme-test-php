<?php

namespace Tests\Feature\Todo;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * @test
     */
    public function index_should_return_successful_response()
    {
        Http::fake([
            '*' => Http::response([[
                'checked' => false,
                'createdAt' => 1675207417659,
                'text' => 'Hello there',
                'id' => '4a0d30b0-a1be-11ed-a408-4d2bbe28719a',
                'updatedAt' => 1675330369104,
            ]]),
        ]);
        $response = $this->get('/todos');

        $response->assertStatus(200);
    }
}
