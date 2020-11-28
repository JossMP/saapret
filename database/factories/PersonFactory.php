<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'           => $this->faker->firstName,
            'last_name'      => $this->faker->lastName . ' ' . $this->faker->lastName,
            'photo'          => $this->faker->optional(0.7)->randomElement(['23969368.jpg', '44274790.jpg', '44274792.jpg', '44650963.jpg', '73501651.jpg', '77663725.jpg']),
            'birthday'       => $this->faker->dateTimeBetween('now', '+30 years'),
            'doc_type'       => $this->faker->randomElement(['DNI', 'CE', 'Pasaporte']),
            'doc_num'        => $this->faker->unique()->randomNumber(8),
            'marital_status' => $this->faker->randomElement(['Soltero(a)', 'Casado(a)']),
            'location_home'  => $this->faker->randomNumber(6),
            'location_birth' => $this->faker->randomNumber(6),
            'address'        => $this->faker->address,
            'email'          => $this->faker->freeEmail,
            'phone'          => $this->faker->phoneNumber,
            'published'      => $this->faker->boolean,
            'verified'       => $this->faker->boolean,
            'slug'           => function (array $person) {
                return Str::slug($person['name'] . ' ' . $person['last_name'] . ' ' . $person['doc_num']);
            },
        ];
    }
}
