<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('isAdmin', function(User $user){
            return $user->role == 'admin';
        });
        Gate::define('isMahasiswa', function(User $user){
            return $user->role == 'mahasiswa';
        });
        Gate::define('isDosen', function(User $user){
            return $user->role == 'dosen';
        });
        Gate::define('isKaprodi', function(User $user){
            return $user->role == 'kaprodi';
        });
    }
}
