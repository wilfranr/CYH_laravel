<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Pedido;

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
        $this->registerViewComposers();
        view()->composer('*', function ($view) {
            $view->with('darkMode', session('dark_mode', config('adminlte.dark_mode')));
        });
    }

    private function registerViewComposers()
    {
        View::composer('adminlte::partials.sidebar', function ($view) {
            $pedidosNuevos = Pedido::where('estado', 'nuevo')->count();
            $view->with('pedidosNuevos', $pedidosNuevos);
        });
    }
}
