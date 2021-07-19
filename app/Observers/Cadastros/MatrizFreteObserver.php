<?php

namespace App\Observers\Cadastros;

use App\Models\Cadastros\MatrizFrete;
use Illuminate\Support\Str;

class MatrizFreteObserver
{
    /**
     * Handle the MatrizFrete "creating" event.
     *
     * @param  \App\Models\Cadastros\MatrizFrete  $matrizFrete
     * @return void
     */
    public function creating(MatrizFrete $matrizFrete)
    {
        $dados = Str::replace('.',"",$matrizFrete->area_plantada);
        $matrizFrete->area_plantada = doubleval(Str::replace(',',".",$dados));
    }

    /**
     * Handle the MatrizFrete "updating" event.
     *
     * @param  \App\Models\Cadastros\MatrizFrete  $matrizFrete
     * @return void
     */
    public function updating(MatrizFrete $matrizFrete)
    {
        $dados = Str::replace('.',"",$matrizFrete->area_plantada);
        $matrizFrete->area_plantada = doubleval(Str::replace(',',".",$dados));
    }

    /**
     * Handle the MatrizFrete "deleted" event.
     *
     * @param  \App\Models\Cadastros\MatrizFrete  $matrizFrete
     * @return void
     */
    public function deleted(MatrizFrete $matrizFrete)
    {
        //
    }

    /**
     * Handle the MatrizFrete "restored" event.
     *
     * @param  \App\Models\Cadastros\MatrizFrete  $matrizFrete
     * @return void
     */
    public function restored(MatrizFrete $matrizFrete)
    {
        //
    }

    /**
     * Handle the MatrizFrete "force deleted" event.
     *
     * @param  \App\Models\Cadastros\MatrizFrete  $matrizFrete
     * @return void
     */
    public function forceDeleted(MatrizFrete $matrizFrete)
    {
        //
    }
}
