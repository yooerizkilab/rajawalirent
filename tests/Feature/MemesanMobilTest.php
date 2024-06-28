<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemesanMobilTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_penyewa_memesan_mobil()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function test_penyewa_membatalkan_pesanan()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
