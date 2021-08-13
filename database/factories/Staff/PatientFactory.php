<?php

namespace Database\Factories\Staff;


use Illuminate\Support\Str;
use App\Models\Staff\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'sex' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'lang' => $this->faker->randomElement(['en', 'es']),
            'password' => Hash::make(Str::random(10))
        ];
    }
}
