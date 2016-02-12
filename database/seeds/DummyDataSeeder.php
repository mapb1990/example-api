<?php

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class DummyDataSeeder
 *
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 10)->create();

    }
}
