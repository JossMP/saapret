<?php

namespace Database\Factories;

use App\Models\Career;
use App\Models\Degree;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CareerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Career::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->sentence(6),
            'description'   => $this->faker->text(500),
            'title'         => $this->faker->randomElement(['Profesor de Educacion Primaria', 'Profesor de Educacion Secundaria', 'Profesional tecnico en Computacion e Informatica']),
            'profession_id' => Profession::inRandomOrder()->value('id'),
            'degree_id'     => Degree::inRandomOrder()->value('id'),
            'icon'          => $this->faker->randomElement(['fa fa-graduation-cap', 'fa fa-user-graduate', 'fa fa-laptop-code', 'fa fa-microscope', 'fa fa-swimmer']),
            'slug'          => function (array $career) {
                return Str::slug($career['name']);
            },
        ];
    }
}
