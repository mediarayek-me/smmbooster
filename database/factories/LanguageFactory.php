<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => 'english',
            'code' => 'en',
            'image' => 'en.jpg',
            'sort' => 1,
            'direction' => 'rtl',
            'status' => 'active',
            'is_default' => 'yes'
        ];
    }
}
