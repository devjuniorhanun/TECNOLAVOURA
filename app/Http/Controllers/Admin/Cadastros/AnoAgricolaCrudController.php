<?php

namespace App\Http\Controllers\Admin\Cadastros;

use App\Http\Requests\Cadastros\AnoAgricolaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AnoAgricolaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AnoAgricolaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cadastros\AnoAgricola::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cadastros/ano-agricola');
        CRUD::setEntityNameStrings('Ano Agrícola', 'Ano Agrícolas');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::enableExportButtons();
        CRUD::column('nome')->label('Ano Agrícola.:');
        CRUD::column('data_abertura')->label('Abertura.:')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('data_fechamento')->label('Fechamento.:')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('status')->label('Status.:')->size(3)->type('enum');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(AnoAgricolaRequest::class);

        CRUD::field('nome')->label('Ano Agrícola.:')->size(3);
        CRUD::field('data_abertura')->label('Abertura.:')->size(3);
        CRUD::field('data_fechamento')->label('Fechamento.:')->size(3);
        CRUD::field('status')->label('Status.:')->size(3)->type('enum');
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

        CRUD::column('nome')->label('Ano Agrícola');
        CRUD::column('data_abertura')->label('Abertura')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('data_fechamento')->label('Fechamento')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('status')->label('Status')->size(3)->type('enum');
    }
}
