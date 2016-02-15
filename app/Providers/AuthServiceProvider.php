<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->before(function (User $user, $ability) {
            switch ($ability) {
                case 'view-clinics':
                case 'create-clinics':
                case 'edit-clinics':
                case 'view-professionals':
                case 'create-professionals':
                case 'delete-professionals':
                    return $user->role == User::ADMIN_ROLE;

                case 'view-patients':
                case 'create-patients':
                case 'edit-patients':
                case 'deactivate-patients':
                case 'define-rehabilitations':
                    return $user->role == User::PROFESSIONAL_ROLE;
            }

            return false;
        });
    }
}
