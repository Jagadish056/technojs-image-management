<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Password::defaults(fn () => Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised());
        Paginator::defaultView('section.pagination');

        // DB::listen(fn ($query) => logger($query->sql, $query->bindings, $query->time));
    }
}
