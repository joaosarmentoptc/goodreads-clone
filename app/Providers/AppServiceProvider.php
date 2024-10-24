<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Bluemmb\Faker\PicsumPhotosProvider;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FakerGenerator::class, function () {
            $faker = FakerFactory::create();
            $faker->addProvider(new PicsumPhotosProvider($faker));

            return $faker;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
