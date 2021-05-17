<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->userName,
            'cellphone' => $this->faker->phoneNumber,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('Pa$$w0rd!'),
            'lang' => $this->faker->randomElement(['en', 'es']),
            'active' => true,
            'show' => true,
            'set_pass' => true,
            'color' => $this->faker->unique()->hexcolor,
            'specialty_id' => $this->faker->randomElement(['1', '2', '3', '4', '5', '6']),
            'remember_token' => Str::random(10),
        ];
    }
}
