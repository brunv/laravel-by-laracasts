<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

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
        // Para evitar erro durante migração:
        Schema::defaultStringLength(191);

        // Custom Blade Directives:
        // Não esquecer que Laravel mantém cache das views, então use
        // 'php artisan view:clear'
        Blade::directive('hello', function($expression) {
            // dd($noun);   // isso é feito por regex
            return "<?= 'hello '. $expression; ?>";
        });
        Blade::directive('ago', function($user) {
            // dd($user);  // por usar regex não pega objetos e sim strings
            // transformando essa string em objeto com o Helper 'with()' em versões antigas
            return "<?= with({$user}->updated_at->diffForHumans()); ?>";
        });
    }
}
