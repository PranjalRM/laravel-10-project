<?php

namespace App\Providers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;


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
        Model::preventLazyLoading();
        Gate::define('edit-job', function (User $user, Job $job) {
            return true;
        });
        Gate::define('view-my-jobs',function ($user) {
            return $user->id = auth()->id();
        });
        
    }
}
