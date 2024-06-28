<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KonfirmasiPesananTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_penyewa_melakukan_konfirmasi_pesanan()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
