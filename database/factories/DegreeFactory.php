<?php

namespace Database\Factories;

use App\Models\Degree;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DegreeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Degree::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->sentence(),
            'short' => $this->faker->title,
            'slug'          => function (array $degree) {
                return Str::slug($degree['name'] . ' ' . $degree['short']);
            },
        ];
    }
}
