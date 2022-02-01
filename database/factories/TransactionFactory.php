<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if(!User::all()->count()) User::factory(4)->create();
        if(!PaymentMethod::all()->count()) PaymentMethod::factory(4)->create();

        $users_ids = User::all()->pluck('id');
        $payments_methods_ids = User::all()->pluck('id');
        return [
            'method_id'=>$this->faker->randomElement($payments_methods_ids),
            'user_id' =>$this->faker->randomElement($users_ids),
            'amount' =>$this->faker->numberBetween(100,1000),
            'fee' =>$this->faker->numberBetween(10,30),
            'profit' =>0,
            'status' => 'paid',
            'take_fee' => 0,
            'transaction_id'=>$this->faker->bothify('********************')
        ];
    }
}
