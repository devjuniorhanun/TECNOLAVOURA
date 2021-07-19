<?php

namespace App\Providers;

use App\Models\Cadastros\{
    Fazenda,
    LocacaoTalhao,
    MatrizFrete,
    Talhao};
use App\Observers\Cadastros\{
    FazendaObserver,
    LocacaoTalhaoObserver,
    MatrizFreteObserver,
    TalhaoObserver};
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
        Talhao::observe(TalhaoObserver::class);
        LocacaoTalhao::observe(LocacaoTalhaoObserver::class);
        MatrizFrete::observe(MatrizFreteObserver::class);
    }
}
