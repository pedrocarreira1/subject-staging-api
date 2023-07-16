<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Subject\Domain\Contracts\SubjectRepositoryContract;
use Src\Subject\Infrastructure\Repositories\SubjectEloquentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SubjectRepositoryContract::class, SubjectEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
