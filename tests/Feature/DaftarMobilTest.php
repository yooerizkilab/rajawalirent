<?php

namespace Tests\Feature;

use App\Models\Produk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DaftarMobilTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_penyewa_menampilkan_daftar_mobil()
    {
        $response = $this->get('/cars');
        $response->assertStatus(200);
        $response->assertSee('Choose Your Car');
    }

    /** @test */
    public function test_penyewa_menampilkan_daftar_mobil_by_nama()
    {
        $response = $this->get('/cars');
        $response->assertStatus(200);
        $response->assertSee('Choose Your Car');
    }
}
