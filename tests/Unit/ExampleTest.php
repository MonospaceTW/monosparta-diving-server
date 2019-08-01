<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // public function testBasicTest()
    // {
    //     $this->assertTrue(true);
    // }
    public function testApplication()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(500, $response->status());
    }
}
