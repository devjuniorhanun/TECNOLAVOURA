<?php

namespace App\Http\Controllers\Admin\Cadastros;

use App\Http\Requests\Cadastros\TenantRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TenantCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TenantCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cadastros\Tenant::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cadastros/empresas');
        CRUD::setEntityNameStrings('Empresa', 'Empresas');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('nome')->label('Empresa');
        CRUD::column('cnpj');
        CRUD::column('email');
        CRUD::column('telefone');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TenantRequest::class);
        CRUD::field('nome')
            ->size(4)
            ->label('Empresa.:');
        

        CRUD::field('cnpj')
            ->size(3)
            ->label('Cpf / Cnpj.:')
            ->attributes(['class' => 'form-control cpfcnpj']);
        CRUD::field('inscricao')
            ->size(3)
            ->label('Rg / Inscrição.:');
        
        CRUD::field('status')
            ->size(2)
            ->type('enum');
        CRUD::field('url')
            ->size(3)
            ->label('Site.:');
        CRUD::field('email')
            ->size(3)
            ->label('Email.:');
        CRUD::field('telefone')
            ->size(3)
            ->label('Telefone.:')
            ->attributes(['class' => 'form-control telefone']);

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
}
