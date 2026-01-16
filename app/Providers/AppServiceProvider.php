<?php

namespace App\Providers;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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

    // Custom binding: only fetch tasks that belong to logged-in user
    Route::bind('task', function ($value) {
        return Task::where('id', $value)
                   ->where('user_id', auth()->id())
                   ->firstOrFail();
    });
}
}
