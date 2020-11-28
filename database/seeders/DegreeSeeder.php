<?php

namespace Database\Seeders;

use App\Models\Degree;
use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'name'  => 'Bachiller',
                'short' => 'Bach.',
            ], [
                'name'  => 'Licenciado',
                'short' => 'Lic.',
            ], [
                'name'  => 'Magister',
                'short' => 'Msg.',
            ], [
                'name'  => 'Doctor',
                'short' => 'Dr.',
            ], [
                'name'  => 'Doctor en Filosofía', // No es un grado academico
                'short' => 'Ph.D.',
            ],
        ];

        foreach ($list as $degree) {
            Degree::factory()->create($degree);
        }
    }
}
