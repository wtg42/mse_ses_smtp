<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MseIpListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMseIpList()
    {
        $response = $this->get('/api/IPList');

        $response->assertStatus(200);
    }
}
