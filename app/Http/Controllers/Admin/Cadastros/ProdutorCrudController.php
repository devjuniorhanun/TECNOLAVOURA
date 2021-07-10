<?php

namespace App\Http\Controllers\Admin\Cadastros;

use App\Http\Requests\Cadastros\ProdutorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProdutorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProdutorCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cadastros\Produtor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cadastros/produtor');
        CRUD::setEntityNameStrings('Produtor', 'Produtores');
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
        CRUD::column('proprietario_id')->type('select')
            ->entity('Proprietario')
            ->attribute('razao_social')
            ->size(4);
        CRUD::column('status')->label('Status.:')->type('enum')->size(2);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProdutorRequest::class);

        CRUD::field('proprietario_id')
            ->type('select2')
            ->entity('proprietario')
            ->attribute('nome_fantasia')
            ->options(function ($query) {
                return $query->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(4);
        CRUD::field('status')->type('enum')->size(2);
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

        CRUD::column('proprietario_id')->type('select')
            ->entity('Proprietario')
            ->attribute('razao_social')
            ->size(4);
        CRUD::column('status')->label('Status.:')->type('enum')->size(2);
    }
}
