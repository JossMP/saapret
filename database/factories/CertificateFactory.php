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
            'mention'    => $this->faker->realText(300),
            'organizer'  => $this->faker->company(),
            'place'      => $this->faker->realText(250),
            'start_date' => $this->faker->date('Y-m-d', 'now'),
            'order'      => rand(0, 10),
            'person_id'  => Person::inRandomOrder()->value('id'),
        ];
    }
}
