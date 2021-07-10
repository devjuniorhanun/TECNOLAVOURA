<?php

namespace App\Providers;

use App\Models\Cadastros\Fazenda;
use App\Observers\Cadastros\FazendaObserver;
use Illuminate\Support\ServiceProvider;

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
        Fazenda::observe(FazendaObserver::class);
    }
}
