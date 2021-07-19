<?php

namespace App\Http\Controllers\Admin\Cadastros;

use App\Http\Requests\Cadastros\MatrizFreteRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MatrizFreteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MatrizFreteCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cadastros\MatrizFrete::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cadastros/matriz-frete');
        CRUD::setEntityNameStrings('Matriz Frete', 'Matriz Fretes');
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
        CRUD::column('bloco');
        CRUD::column('percurso');
        CRUD::column('frete')->type('number')
        ->prefix('R$ ')
        ->decimals(2)
        ->dec_point(',')
        ->thousands_sep('.');
        CRUD::column('status');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MatrizFreteRequest::class);

        CRUD::field('safra_id')
        ->type('select2')
        ->entity('safra')
        ->attribute('nome')
        ->options(function ($query) {
            return $query->where('status','=', 'ATIVO')->orderBy('nome', 'ASC')->get();
        })
        ->size(3);
        CRUD::field('bloco')->size(2);
        CRUD::field('percurso')->size(2);
        CRUD::field('frete')->size(2)->attributes(['class' => 'form-control areas']);
        CRUD::field('status')->size(2)->type('enum');
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
        $this->crud->set('show.setFromDb', false);
        CRUD::column('safra_id')->type('select')
            ->entity('Safra')
            ->attribute('nome')
            ->size(4);
        CRUD::column('bloco')->size(2);
        CRUD::column('percurso')->size(2);
        CRUD::column('frete')->size(2)
        ->type('number')
        ->decimals(2)
        ->prefix('R$ ')
        ->dec_point(',')
        ->thousands_sep('.');
        CRUD::column('status')->type('enum')->size(2);
    }
}
