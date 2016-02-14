<?php

use Illuminate\Database\Seeder;

/**
 * Class ClinicTableSeeder
 *
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class ClinicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clinics')->truncate();

        DB::table('clinics')->insert([
            'name' => 'Clínica do Porto',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
