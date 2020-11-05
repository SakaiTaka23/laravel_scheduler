<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Service\ScheduleServiceInterface;
use App\Service\Production\ScheduleService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ScheduleServiceInterface::class, ScheduleService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
