<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
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
                'name'  => 'Profesor',
                'short' => 'Prof.',
            ], [
                'name'  => 'Licenciado',
                'short' => 'Lic.',
            ], [
                'name'  => 'Ingeniero',
                'short' => 'Ing.',
            ], [
                'name'  => 'Arquitecto',
                'short' => 'Arq.',
            ], [
                'name'  => 'Tecnico',
                'short' => 'Tec.',
            ], [
                'name'  => 'Medico',
                'short' => 'Dr.',
            ], [
                'name'  => 'Enfermera',
                'short' => 'Enf.',
            ], [
                'name'  => 'Psicologo',
                'short' => 'Dr.',
            ], [
                'name'  => 'Abogado',
                'short' => 'Abog.',
            ],
        ];

        foreach ($list as $profession) {
            Profession::factory()->create($profession);
        }
    }
}
