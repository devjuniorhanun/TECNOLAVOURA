<?php

namespace App\Observers\Cadastros;

use App\Models\Cadastros\Talhao;
use Illuminate\Support\Str;

class TalhaoObserver
{
    /**
     * Handle the Talhao "creating" event.
     *
     * @param  \App\Models\Cadastros\Talhao  $talhao
     * @return void
     */
    public function creating(Talhao $talhao)
    {
        $dados = Str::replace('.',"",$talhao->area_total);
        $talhao->area_total = doubleval(Str::replace(',',".",$dados));
    }

    /**
     * Handle the Talhao "updating" event.
     *
     * @param  \App\Models\Cadastros\Talhao  $talhao
     * @return void
     */
    public function updating(Talhao $talhao)
    {
        $dados = Str::replace('.',"",$talhao->area_total);
        $talhao->area_total = doubleval(Str::replace(',',".",$dados));
    }

}
