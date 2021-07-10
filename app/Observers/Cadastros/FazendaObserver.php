<?php

namespace App\Observers\Cadastros;

use App\Models\Cadastros\Fazenda;
use Illuminate\Support\Str;

class FazendaObserver
{
    /**
     * Handle the Fazenda "creating" event.
     *
     * @param  \App\Models\Cadastros\Fazenda  $fazenda
     * @return void
     */
    public function creating(Fazenda $fazenda)
    {
        $dados = Str::replace('.',"",$fazenda->area_total);
        $fazenda->area_total = doubleval(Str::replace(',',".",$dados));
        
    }

    /**
     * Handle the Fazenda "updating" event.
     *
     * @param  \App\Models\Cadastros\Fazenda  $fazenda
     * @return void
     */
    public function updating(Fazenda $fazenda)
    {
        $dados = Str::replace('.',"",$fazenda->area_total);
        $fazenda->area_total = doubleval(Str::replace(',',".",$dados));
    }

    
}
