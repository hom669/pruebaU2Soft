<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_vendor' => $this->faker->numberBetween(1,10),
            'name_product'=> $this->faker->regexify('[A-Za-z0-9]{20}'),
            'description_product'=> $this->faker->sentence(),
            'codbar_product'=> Str::random(10),
        ];
    }
}
