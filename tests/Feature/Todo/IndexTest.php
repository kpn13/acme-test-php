<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * @test
     */
    public function index_should_return_successful_response()
    {
        $response = $this->get('/todos');

        $response->assertStatus(200);
    }
}
