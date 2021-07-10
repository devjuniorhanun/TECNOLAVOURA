<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    // Cadastros
    Route::crud('cadastros/empresas', 'Cadastros\TenantCrudController');
    Route::crud('cadastros/safra', 'Cadastros\SafraCrudController');
    Route::crud('cadastros/cultura', 'Cadastros\CulturaCrudController');
    Route::crud('cadastros/variedade-cultura', 'Cadastros\VariedadeCulturaCrudController');
    Route::crud('cadastros/proprietario', 'Cadastros\ProprietarioCrudController');
    Route::crud('cadastros/produtor', 'Cadastros\ProdutorCrudController');
    Route::crud('cadastros/fazenda', 'Cadastros\FazendaCrudController');
    Route::crud('cadastros/talhao', 'Cadastros\TalhaoCrudController');
    Route::get('cadastros/talhao/areaTalhao/{idTalhao}', 'Cadastros\TalhaoCrudController@areaTalhao');
}); // this should be the absolute last line of this file