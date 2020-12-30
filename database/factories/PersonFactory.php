<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Person;
use App\Models\User;
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
        $gender = $this->faker->randomElement(['male', 'female']);
        $photo = ($gender == 'male') ? $this->faker->optional(0.7)->randomElement(['M001.jpg', 'M002.jpg', 'M003.jpg', 'M004.jpg']) : $this->faker->optional(0.7)->randomElement(['F001.jpg', 'F002.jpg', 'F003.jpg', 'F004.jpg']);
        return [
            'name'           => $this->faker->firstName($gender),
            'last_name'      => $this->faker->lastName . ' ' . $this->faker->lastName,
            'photo'          => $photo,
            'birthday'       => $this->faker->dateTimeBetween('now', '+30 years'),
            'doc_type'       => $this->faker->randomElement(['DNI', 'CE', 'Pasaporte']),
            'doc_num'        => $this->faker->unique()->randomNumber(8),
            'marital_status' => $this->faker->randomElement(['Soltero(a)', 'Casado(a)']),
            'location_home'  => District::inRandomOrder()->value('id'), //$this->faker->randomNumber(6),
            'location_birth' => District::inRandomOrder()->value('id'), //$this->faker->randomNumber(6),
            'user_id'        => $this->faker->optional(0.01)->randomElement([User::inRandomOrder()->value('id')]),
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
