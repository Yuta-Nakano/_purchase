<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name'              => $this->faker->unique()->regexify('[a-zA-Z0-9_-]{6,12}'),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',    // password
            'email'             => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'birthday'          => $this->faker->optional()->date('Y-m-d', 'now'),
            'sex'               => $this->faker->optional()->randomElement(['male', 'female']),
            'remember_token'    => Str::random(10),
        ];
    }
}
