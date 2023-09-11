<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'image' => null, // Vous pouvez adapter cette valeur en fonction de vos besoins
            'newsletter' => $this->faker->boolean, // Génère une valeur booléenne aléatoire
            'member' => $this->faker->boolean, // Génère une valeur booléenne aléatoire
            'date_member' => $this->faker->date, // Génère une date aléatoire
            'hrsremaining' => $this->faker->numberBetween(0, 50), // Génère un nombre aléatoire entre 0 et 50
            'admin' => false, // Vous pouvez adapter cette valeur en fonction de vos besoins
            'password' => bcrypt('password'), // Vous pouvez générer un mot de passe haché
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
