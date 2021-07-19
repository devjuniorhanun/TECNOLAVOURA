<?php

namespace App\Http\Controllers\Admin\Cadastros;

use App\Http\Requests\Cadastros\LocacaoTalhaoRequest;
use App\Models\Cadastros\VariedadeCultura;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class LocacaoTalhaoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LocacaoTalhaoCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Cadastros\LocacaoTalhao::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cadastros/locacao-talhao');
        CRUD::setEntityNameStrings('Locação Talhão', 'Locações Talhões');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->enableExportButtons();
        $this->crud->addClause('whereHas', 'safra', function ($query) {
            $query->where('status', '=', 'ATIVO');
        });
        CRUD::column('safra_id')->type('select')
            ->entity('Safra')
            ->attribute('nome')
            ->size(4);

        CRUD::column('cultura_id')->type('select')
            ->entity('Cultura')
            ->attribute('nome')
            ->size(4);

        CRUD::column('variedade_cultura_id')
            ->label('Variedade')
            ->type('select')
            ->entity('VariedadeCultura')
            ->attribute('nome')
            ->size(4);

        CRUD::column('talhao_id')
            ->label('Talhão')
            ->type('select')
            ->entity('Talhao')
            ->attribute('nome')
            ->size(4);


        CRUD::column('area_plantada')->size(2)
            ->label('Área Plantada')
            ->type('number')
            ->decimals(2)
            ->suffix(' ha')
            ->dec_point(',')
            ->thousands_sep('.');

        CRUD::column('inicio_plantio')->label('Inicio Plantio')->type('date')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('final_plantio')->label('Final Plantio')->type('date')->type('datetime')->format('DD/MM/YYYY');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(LocacaoTalhaoRequest::class);

        CRUD::field('safra_id')
            ->type('select2')
            ->entity('safra')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->where('status','=', 'ATIVO')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('cultura_id')
            ->type('select2')
            ->entity('cultura')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->where('status','=', 'ATIVO')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('variedade_cultura_id')
            ->label('Variedade')
            ->type('select2_from_ajax')
            ->entity('variedadeCultura')
            ->attribute('nome')
            ->data_source('variedade')
            ->placeholder('Variedade')
            ->include_all_form_fields(true)
            ->minimum_input_length(0)
            ->dependencies(['cultura_id'])
            ->method('post')
            ->model('App\Models\Cadastros\VariedadeCultura')
            ->size(3);

        CRUD::field('talhao_id')
        ->label('Talhão')
            ->type('select2')
            ->entity('talhao')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->where('status','=', 'ATIVO')->orderByDesc('id')->get();
            })
            ->size(3);

        CRUD::field('area_plantada')->label('Areá Plantada')->size(3)->attributes(['class' => 'form-control areas']);
        CRUD::field('semente_linear')->label('Sementes Linear')->size(3);
        CRUD::field('semente_populacao')->label('População')->size(3);
        CRUD::field('inicio_plantio')->label('Inicio Plantio')->size(3);
        CRUD::field('final_plantio')->label('Fim Plantio')->size(3);
        CRUD::field('data_prevista')->label('Data Colheita')->size(3);
        CRUD::field('observacoes')->label('Obervações')->size(3);
        CRUD::field('status')->size(3)->type('enum');
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        CRUD::column('safra_id')->type('select')
            ->entity('Safra')
            ->attribute('nome')
            ->size(4);

        CRUD::column('cultura_id')->type('select')
            ->entity('Cultura')
            ->attribute('nome')
            ->size(4);

        CRUD::column('variedade_cultura_id')
            ->type('select')
            ->entity('VariedadeCultura')
            ->attribute('nome')
            ->size(4);

        CRUD::column('talhao_id')
            ->type('select')
            ->entity('Talhao')
            ->attribute('nome')
            ->size(4);

        CRUD::column('area_plantada')->size(2)
        ->type('number')
        ->decimals(2)
        ->suffix(' ha')
        ->dec_point(',')
        ->thousands_sep('.');
        CRUD::column('semente_linear')->size(4);
        CRUD::column('semente_populacao')->size(4);
        CRUD::column('inicio_plantio')->type('date')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('final_plantio')->type('date')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('data_prevista')->type('date')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('observacoes')->size(4);
        CRUD::column('status')->type('enum')->size(4);
    }

    public function variedade(Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');

        if ($search_term) {
            $options = VariedadeCultura::where('nome', 'LIKE', '%' . $search_term . '%')->paginate(1000000);
        } else {
            $options = VariedadeCultura::where('cultura_id', $form['cultura_id'])->paginate(1000000);
        }
        return $options;
    }
}
