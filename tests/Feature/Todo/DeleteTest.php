<?php

namespace Tests\Feature\Todo;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /**
     * @test
     */
    public function delete_should_return_successful_response()
    {
        Http::fake([
            '*' => Http::sequence()
                    ->push()
                    ->push(),
        ]);

        $response = $this->followingRedirects()->delete('/todos/4a0d30b0-a1be-11ed-a408-4d2bbe28719a', [
            'text' => 'Test todo',
            'checked' => true,
        ]);

        $response->assertStatus(200);
    }
}
