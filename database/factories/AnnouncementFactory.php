<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['new service','disabled service','updated service','announcement']),
            'start'=> $this->faker->date(),
            'end'=> $this->faker->date(),
            'status' => $this->faker->randomElement(['active','deactive']),
            'description'=> $this->faker->text(240),
        ];
    }
}
