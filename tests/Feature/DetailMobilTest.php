<?php

namespace Tests\Feature;

use App\Models\Produk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DetailMobilTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_penyewa_melihat_detail_mobil()
    {
        // Membuat request ke route yang menampilkan detail mobil
        $response = $this->get('/cars');

        // Memastikan status response adalah 200 (OK)
        $response->assertStatus(200);
    }
}
