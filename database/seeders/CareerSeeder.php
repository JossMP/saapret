<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pedagogico Puno
        $list = [
            [
                'name'        => 'Educación Inicial',
                'description' => 'Educación Inicial',
            ], [
                'name'        => 'Educación Primaria',
                'description' => 'Educación Primaria',
            ], [
                'name'        => 'Educación Secundaria - Comunicación',
                'description' => 'Educación Secundaria - Comunicación',
            ], [
                'name'        => 'Educación Secundaria - Ciencias Sociales',
                'description' => 'Educación Secundaria - Ciencias Sociales',
            ],  [
                'name'        => 'Educación Secundaria - Ciencia, Tecnología y Ambiente',
                'description' => 'Educación Secundaria - Ciencia, Tecnología y Ambiente',
            ], [
                'name'        => 'Educación Secundaria - Matemática',
                'description' => 'Educación Secundaria - Matemática',
            ], [
                'name'        => 'Computación e Informática',
                'description' => 'Computación e Informática',
            ], [
                'name'        => 'Educación Física',
                'description' => 'Educación Física',
            ],
        ];
        /*
        $list = [
            // Inicial
            [
                'name'        => 'Educación Inicial',
                'description' => 'Educación Inicial',
            ], [
                'name'        => 'Educación Inicial (Intercultural y Bilingüe)',
                'description' => 'Educación Inicial',
            ],
            // Primaria
            [
                'name'        => 'Educación Primaria',
                'description' => 'Educación Primaria',
            ], [
                'name'        => 'Educación Primaria (Intercultural y Bilingüe)',
                'description' => 'Educación Primaria',
            ],
            // Secundaria
            [
                'name'        => 'Educación Secundaria - Ciencia, Tecnología y Ambiente',
                'description' => 'Educación Secundaria - Ciencia, Tecnología y Ambiente',
            ], [
                'name'        => 'Educación Secundaria - Ciencias Sociales',
                'description' => 'Educación Secundaria - Ciencias Sociales',
            ], [
                'name'        => 'Educación Secundaria - Comunicación',
                'description' => 'Educación Secundaria - Comunicación',
            ], [
                'name'        => 'Educación Secundaria - Matemática',
                'description' => 'Educación Secundaria - Matemática',
            ], [
                'name'        => 'Educación Secundaria - Computacion',
                'description' => 'Educación Secundaria - Computacion',
            ], [
                'name'        => 'Educación Secundaria Técnica',
                'description' => 'Educación Secundaria Técnica',
            ], [
                'name'        => 'Educación Física',
                'description' => 'Educación Física',
            ],
        ];*/

        foreach ($list as $career) {
            Career::factory()->create($career);
        }
    }
}
