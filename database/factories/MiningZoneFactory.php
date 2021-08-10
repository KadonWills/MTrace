<?php

namespace Database\Factories;

use App\Models\MiningZone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MiningZoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MiningZone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstname(),
            'lastname' => $this->faker->lastname(),
            'username' => $this->faker->unique()->username(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
               // 'email_verified_at' => null,
            ];
        });
    }
}
