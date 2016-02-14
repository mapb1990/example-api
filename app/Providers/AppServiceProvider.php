<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('pt_PT');
        });
    }
}
