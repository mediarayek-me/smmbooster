<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       Category::factory(2)->create();
       //$categries = Category::get()->toArray();
        return [
            'name' => $this->faker->unique()->text(80),
            'category_id' => $this->faker->randomElement([1,2]),
            'type' => 'normal',
            'status' => 'active',
            'rate'=> $this->faker->numberBetween(0,10)/10,
            'min' => $this->faker->numberBetween(10,100),
            'max' => 10000,
            'percentage_increase' => 20,
            'description' => $this->faker->text(100)
        ];
    }
}
