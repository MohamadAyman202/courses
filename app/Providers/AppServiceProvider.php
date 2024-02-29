<?php

namespace App\Providers;

use App\Http\Controllers\CustomLaravelLog;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LogViewer::extend('laravel', CustomLaravelLog::class);
        Paginator::useBootstrap();
    }
}
