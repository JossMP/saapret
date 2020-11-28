<?php

namespace Database\Factories;

use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProfessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profession::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->jobTitle,
            'short' => $this->faker->title(),
            'slug'  => function (array $profession) {
                return Str::slug($profession['short'] . ' ' . $profession['name']);
            },
        ];
    }
}
