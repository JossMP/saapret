<?php

namespace Database\Factories;

use App\Models\Certificate;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Certificate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mention'    => $this->faker->realText(200),
            'organizer'  => $this->faker->company(),
            'place'      => $this->faker->city,
            'hours'      => (rand(4, 8) * 2),
            'start_date' => $this->faker->date('Y-m-d', 'now'),
            'end_date'   => $this->faker->date('Y-m-d', 'now'),
            'order'      => rand(0, 10),
            'person_id'  => Person::inRandomOrder()->value('id'),
        ];
    }
}
