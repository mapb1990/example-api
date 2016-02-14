<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SpecialtyTableSeeder::class);
        $this->call(ClinicTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
