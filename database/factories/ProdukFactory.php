<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    protected $model = Produk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'varian' => $this->faker->word,
            'merk' => $this->faker->company,
            'plat' => strtoupper($this->faker->bothify('?? ### ??')),
            'unit' => $this->faker->numberBetween(1, 10),
            'gambar' => $this->faker->imageUrl(640, 480, true, 'Faker'),
        ];
    }
}
