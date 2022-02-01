<?php

namespace Database\Factories;

use App\Models\ApiProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApiProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApiProvider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //b27e443696b6345d153dd514d168a7e2   // momopanel
        //2EHdvKjVv02cpGuYXo2Zs8fGazkFPv2V
        //	https://momopanel.com/api/v2
        // 'https://hqsmartpanel.com/api/v1
        return [
            'name' => 'momopanel.com',
            'url' => 'https://momopanel.com/api/v2',
            'api_key' => 'b27e443696b6345d153dd514d168a7e2',
            'status' => 'active',
            'percentage_increase' => 50,
            'notes' => $this->faker->text(100)
        ];
    }
}
