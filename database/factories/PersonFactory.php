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
            'name'      => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'birthday'  => $this->faker->dateTimeBetween('now', '+30 years'),
            'doc_type'  => $this->faker->randomElement(['DNI', 'CE', 'Pasaporte']),
            'doc_num'   => $this->faker->randomNumber(8),
            'email'     => $this->faker->freeEmailDomain,
            'slug'      => function (array $person) {
                return Str::slug($person['name'] . ' ' . $person['last_name'] . ' ' . $person['doc_num']);
            },
        ];
    }
}
