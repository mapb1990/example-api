<?php

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Professional;
use App\Models\Rehabilitation;
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

        // create professionals
        $users = User::where('role', User::PROFESSIONAL_ROLE)->has('professional', '=', 0)->get();
        $users->each(function (User $user) {
            $user->professional()->save(factory(Professional::class)->make(['clinic_id' => 1]));
        });

        factory(Patient::class, 100)
            ->create(['clinic_id' => 1])
            ->each(function (Patient $patient) {
                for ($i = 0; $i < rand(0, 10); $i++) {
                    $patient->rehabilitations()->save(factory(Rehabilitation::class)->make([
                        'professional_id' => 1
                    ]));
                }
            });
    }
}
