<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::get()->first();
        return [
            'name'=> $this->faker->name,
            'user_id' => $user->id,
            'email'=> $this->faker->unique()->safeEmail,
            'type'=> $this->faker->randomElement(['order','payment','service','api']),
            'status'=> $this->faker->randomElement(['pending','answered','closed']),
            'subject'=>$this->faker->text(20),
            'message'=> $this->faker->text(10),
        ];
    }
}
