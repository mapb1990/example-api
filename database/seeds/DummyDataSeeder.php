<?php

use App\Models\Clinic;
use App\Models\Professional;
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
        factory(User::class, 18)->create();
        factory(Clinic::class, 99)->create();

        $users = User::where('role', User::PROFESSIONAL_ROLE)->has('professional', '=', 0)->get();
        $users->each(function (User $user) {
            $user->professional()->save(factory(Professional::class)->make(['clinic_id' => 1]));
        });
    }
}
