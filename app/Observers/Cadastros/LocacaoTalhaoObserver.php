<?php

namespace App\Observers\Cadastros;

use App\Models\Cadastros\LocacaoTalhao;
use Illuminate\Support\Str;

class LocacaoTalhaoObserver
{
    /**
     * Handle the LocacaoTalhao "creating" event.
     *
     * @param  \App\Models\Cadastros\LocacaoTalhao  $locacaoTalhao
     * @return void
     */
    public function creating(LocacaoTalhao $locacaoTalhao)
    {
        $dados = Str::replace('.',"",$locacaoTalhao->area_plantada);
        $locacaoTalhao->area_plantada = doubleval(Str::replace(',',".",$dados));
    }

    /**
     * Handle the LocacaoTalhao "updating" event.
     *
     * @param  \App\Models\Cadastros\LocacaoTalhao  $locacaoTalhao
     * @return void
     */
    public function updating(LocacaoTalhao $locacaoTalhao)
    {
        $dados = Str::replace('.',"",$locacaoTalhao->area_plantada);
        $locacaoTalhao->area_plantada = doubleval(Str::replace(',',".",$dados));
    }

    /**
     * Handle the LocacaoTalhao "deleted" event.
     *
     * @param  \App\Models\Cadastros\LocacaoTalhao  $locacaoTalhao
     * @return void
     */
    public function deleted(LocacaoTalhao $locacaoTalhao)
    {
        //
    }

    /**
     * Handle the LocacaoTalhao "restored" event.
     *
     * @param  \App\Models\Cadastros\LocacaoTalhao  $locacaoTalhao
     * @return void
     */
    public function restored(LocacaoTalhao $locacaoTalhao)
    {
        //
    }

    /**
     * Handle the LocacaoTalhao "force deleted" event.
     *
     * @param  \App\Models\Cadastros\LocacaoTalhao  $locacaoTalhao
     * @return void
     */
    public function forceDeleted(LocacaoTalhao $locacaoTalhao)
    {
        //
    }
}
