<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->bind(
        //     \Illuminate\Http\Resources\Json\PaginatedResourceResponse::class,
        //     \App\Http\Resources\PaginatedResourceResponse::class
        // );
        $this->app->bind(
            \Illuminate\Pagination\LengthAwarePaginator::class,
            \App\Services\PaginatorService::class
        );
    }
}
