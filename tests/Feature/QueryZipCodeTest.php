<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QueryZipCodeTest extends TestCase
{

    public function test_get_zip_code_a_successful_response(): void
    {
        $response = $this->get('/api/consulta/?cep=33170000', ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }

    public function test_send_wrong_data(): void
    {
        $response = $this->get('/api/consulta/?cep=331700000', ['Accept' => 'application/json']);
        $response->assertStatus(422);
    }
}
