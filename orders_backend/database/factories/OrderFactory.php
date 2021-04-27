<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'applicant'=>$this->faker->name(),
            'date_order'=>$this->faker->dateTimeThisMonth('-10 days', '+10 month'),
            'date_delivery'=>$this->faker->dateTimeBetween('-2 days', '+1 month'),
            'state'=>$this->faker->randomElement(['Entregado', 'No Entrgado', 'Entrgando'])
        ];
    }
}
