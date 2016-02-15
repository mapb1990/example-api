<?php

use App\Models\Professional;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder
 *
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $user = new User([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => '123456'
        ]);
        $user->role = User::ADMIN_ROLE;
        $user->remember_token = str_random(10);

        $user->save();

        $user = new User([
            'name' => 'Profissional',
            'email' => 'prof@gmail.com',
            'password' => '123456'
        ]);
        $user->role = User::PROFESSIONAL_ROLE;
        $user->remember_token = str_random(10);

        $user->save();

        $user->professional()->create([
            'clinic_id' => 1,
            'specialty_id' => 7
        ]);
    }
}
