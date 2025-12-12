<?php

namespace App\Providers;

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
        // Fix para Railway: Forzar HTTPS en producción
        // Soluciona el problema de "Mixed Content" donde el navegador ve HTTPS
        // pero Laravel genera URLs con HTTP
        if($this->app->environment('production') || str_contains(request()->url(), 'railway.app')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Compartir variables de notificaciones con el nuevo layout moderno
        view()->composer('layouts.partials.modern-topbar', function ($view) {
            $licenciasPorVencer = \App\Models\Licencia::where('fecha_vencimiento', '>', \Carbon\Carbon::now())
                                                      ->where('fecha_vencimiento', '<=', \Carbon\Carbon::now()->addDays(30))
                                                      ->where('estado', 1)
                                                      ->limit(5)
                                                      ->get();
            
            $view->with('licenciasPorVencer', $licenciasPorVencer);
        });
    }
}
