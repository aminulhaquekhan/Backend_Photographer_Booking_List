<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Photographers;

class PhotographersFactory extends Factory
{
    protected $model = Photographers::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'specialty' => $this->faker->jobTitle(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'profile_pic' => null,
        ];
    }
}