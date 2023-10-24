<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\Repositories\EmployeeRepository',
            'App\Repositories\Eloquents\EloquentEmployeeRepository'
        );

        $this->app->bind(
            'App\Contracts\Repositories\TeamRepository',
            'App\Repositories\Eloquents\EloquentTeamRepository'
        );
        $this->app->bind(
            'App\Contracts\Repositories\PositionRepository',
            'App\Repositories\Eloquents\EloquentPositionRepository',
        );
        $this->app->bind(
            'App\Contracts\Repositories\TypeOfWorkRepository',
            'App\Repositories\Eloquents\EloquentTypeOfWordRepository',
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        if (App::environment() === 'production' || App::environment() === 'dev') {
            URL::forceScheme('https');
        }
        
    }
}
