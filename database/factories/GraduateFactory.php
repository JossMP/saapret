<?php

namespace Database\Factories;

use App\Models\Career;
use App\Models\Degree;
use App\Models\Graduate;
use App\Models\Person;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;

class GraduateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Graduate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'career_id'   => Career::inRandomOrder()->value('id'),
            'person_id'   => Person::inRandomOrder()->value('id'),
            'degree_id'   => $this->faker->optional(0.9)->randomElement([Degree::inRandomOrder()->value('id')]),
            'title'       => Career::inRandomOrder()->value('title'),
            'title_num'   => $this->faker->numerify('###-#####-##'),
            'mention'     => $this->faker->sentence(),
            'start_year'  => $this->faker->year(),
            'end_year'    => $this->faker->year(),
            'date_issued' => $this->faker->date(),
            'file'        => $this->faker->optional(0.9)->randomElement(['titulo.pdf', 'resolucion.pdf']),
            'published'   => true,
            'order'       => $this->faker->randomDigit,
        ];
    }
}
