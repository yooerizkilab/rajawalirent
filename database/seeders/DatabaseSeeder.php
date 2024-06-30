<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    // public function run()
    // {
    //     User::factory(1)->create();
    //     Produk::factory(5)->create();
    // }
    public function run()
    {
        $this->call(UserTableSeeder::class);
    }
}
