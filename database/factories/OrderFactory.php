<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use App\Models\Service;
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
       $service = Service::factory()->create();
       $user = User::factory()->create();
        return [
        'user_id' => $user->id,
        'service_id' => $service->id,
        'quantity' => 3000,
        'link' => 'https://link.com/332',
        'total'=> 3000 * $service->rate / 1000 ,
        'details' => 'some details',
        'status' => 'pending'
        ];
    }
}
