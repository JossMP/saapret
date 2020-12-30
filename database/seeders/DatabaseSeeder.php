<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Experience;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersSeeder::class);

        // Datos ubigeo
        $this->call(DepartmentSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(DistrictSeeder::class);


        // Data tests
        $this->call(ProfessionSeeder::class);
        $this->call(DegreeSeeder::class);

        $this->call(CareerSeeder::class);

        $this->call(PersonSeeder::class);
        $this->call(GraduateSeeder::class);

        Certificate::factory()->times(500)->create();
        Experience::factory()->times(500)->create();
    }
}
