<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManajemenProdukTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_mebuat_data_mobi()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /** @test */
    public function test_admin_melihat_data_mobil()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /** @test */
    public function test_admin_mengubah_data_mobil()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /** @test */
    public function test_admin_hapus_data_mobil()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
