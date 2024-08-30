<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider{
    // Register any application services.
    
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Schema::defaultStringLength(191);
        /*
        view()->share('datatableConfig', [
            'language' => ['url' => 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'],
            'order' => [[0, 'asc']], // Ordena por la primera columna (id) en orden ascendente
            'columnDefs' => [
                ['type' => 'num', 'targets' => 0] // Asegura que la primera columna sea tratada como numérica
            ]
        ]);
        */
    }
}
