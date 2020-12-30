<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position'    => $this->faker->realText(100),
            'institution' => $this->faker->company,
            'task'        => $this->faker->realText(200),
            'start_date'  => $this->faker->date('Y-m-d', 'now'),
            'end_date'    => $this->faker->date('Y-m-d', 'now'),
            'published'   => $this->faker->boolean,
            'order'       => rand(0, 10),
            'person_id'   => Person::inRandomOrder()->value('id'),
        ];
    }
}
