<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\ServiceRepositoryInterface',
            'App\Repository\ServiceRepository'
        );
        $this->app->bind(
            'App\Repository\ProjectRepositoryInterface',
            'App\Repository\ProjectRepository'
        );
        $this->app->bind(
            'App\Repository\TeamMemberRepositoryInterface',
            'App\Repository\TeamMemberRepository'
        );
        $this->app->bind(
            'App\Repository\PositionRepositoryInterface',
            'App\Repository\PositionRepository'
        );
        $this->app->bind(
            'App\Repository\EmployeeRepositoryInterface',
            'App\Repository\EmployeeRepository'
        );

        $this->app->bind(
            'App\Repository\GalleryRepositoryInterface',
            'App\Repository\GalleryRepository'
        );



    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
