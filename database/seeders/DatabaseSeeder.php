<?php

namespace Database\Seeders;

use App\Models\Graduate;
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

        // Data tests
        $this->call(ProfessionSeeder::class);
        $this->call(DegreeSeeder::class);

        $this->call(CareerSeeder::class);

        $this->call(PersonSeeder::class);
        $this->call(GraduateSeeder::class);
    }
}
