<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_get_sports_table_all_record_example(): void
    {
        
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
