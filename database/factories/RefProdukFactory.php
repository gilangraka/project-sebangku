<?php

namespace Database\Factories;

use App\Models\RefProduk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RefProduk>
 */
class RefProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = RefProduk::class;
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word,
            'harga' => $this->faker->numberBetween(10000, 1000000),
            'gambar_produk' => $this->faker->image('public/gambar_produk', 400, 300, null, false),
            'status_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
