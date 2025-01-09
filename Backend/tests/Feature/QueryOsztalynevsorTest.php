<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QueryOsztalynevsorTest extends TestCase
{
    private $startTime;
    private $endTime;
    private $responseTime;

    public function test_the_queryOsztalynevsorok_response_time(): void
    {
        $this->startTime = microtime(true);

        $response = $this->get('/api/queryOsztalynevsorok');

        $this->endTime = microtime(true);
        $this->responseTime = round(($this->endTime - $this->startTime) * 1000, 2);
        
        $response->assertStatus(200);
        $this->assertLessThan(200, $this->responseTime);
        echo PHP_EOL."\tThe response time(queryOsztalynevsorok): ($this->responseTime) ms";
    }

    // public function tearDown(): void
    // {
    //     parent::tearDown();
    // } 
}
