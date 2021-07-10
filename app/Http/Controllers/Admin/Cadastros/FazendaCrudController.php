<?php

namespace App\Http\Controllers\Admin\Cadastros;

use App\Http\Requests\Cadastros\FazendaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FazendaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FazendaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cadastros\Fazenda::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cadastros/fazenda');
        CRUD::setEntityNameStrings('Fazenda', 'Fazendas');
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
        CRUD::column('produtor_id')->type('relationship')
        ->name('produtor_id')
            ->entity('produtor')
            ->attribute('razao_social')
            ->size(4);
        CRUD::column('nome')->size(4);
        CRUD::column('area_total')
            ->size(2)
            ->type('number')
            ->decimals(2)
            ->suffix(' ha')
            ->dec_point(',')
            ->thousands_sep('.');
        CRUD::column('nome_gerente')->size(2);
        CRUD::column('status')->type('enum')->size(2);
        CRUD::column('cep')->size(2);
        CRUD::column('estado')->size(2);
        CRUD::column('cidade')->size(2);
        CRUD::column('bairro')->size(2);
        CRUD::column('endereco')->size(4);
        CRUD::column('complemento')->size(2);
        CRUD::column('numero')->size(2);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(FazendaRequest::class);

        CRUD::field('proprietario_id')
            ->type('select2')
            ->entity('proprietario')
            ->attribute('nome_fantasia')
            ->options(function ($query) {
                return $query->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(4);

        CRUD::field('produtor_id')
            ->type('select2')
            ->entity('produtor')
            ->attribute('nome_fantasia')
            ->options(function ($query) {
                return $query->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(4);
        CRUD::field('nome')
            ->label('Nome.:')
            ->size(4);
       /* CRUD::field('inscricao_estadual')
            ->label('Inscrição Estadual.:')
            ->attributes(['class' => 'form-control inscricao'])
            ->size(2);*/
        CRUD::field('area_total')
            ->label('Área Total.:')
            ->attributes(['class' => 'form-control areas'])
            ->size(2);
        CRUD::field('nome_gerente')
            ->label('Nome Gerente.:')
            ->size(2);
        CRUD::field('status')
            ->label('Status.:')
            ->type('enum')
            ->size(2);
        CRUD::field('cep')
            ->label('Cep.:')
            ->size(2)
            ->attributes(['id' => 'cep']);
        CRUD::field('estado')
            ->label('Estado.:')
            ->size(1)
            ->attributes(['id' => 'estado']);
        CRUD::field('cidade')
            ->label('Cidade.:')
            ->size(3)
            ->attributes(['id' => 'cidade']);
        CRUD::field('bairro')
            ->label('Bairro.:')
            ->size(2)
            ->attributes(['id' => 'bairro']);
        CRUD::field('endereco')
            ->label('Endereço.:')
            ->size(3)
            ->attributes(['id' => 'endereco']);
        CRUD::field('complemento')
            ->label('Complemento.:')
            ->size(2);
        CRUD::field('numero')
            ->label('Número.:')
            ->size(2);
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
        CRUD::column('produtor_id')->type('select')
            ->entity('Produtor')
            ->attribute('razao_social')
            ->size(4);
        CRUD::column('nome')->size(4);
        CRUD::column('area_total')
            ->size(2)
            ->type('number')
            ->decimals(2)
            ->suffix(' ha')
            ->dec_point(',')
            ->thousands_sep('.');
        CRUD::column('nome_gerente')->size(2);
        CRUD::column('status')->type('enum')->size(2);
        CRUD::column('cep')->size(2);
        CRUD::column('estado')->size(2);
        CRUD::column('cidade')->size(2);
        CRUD::column('bairro')->size(2);
        CRUD::column('endereco')->size(4);
        CRUD::column('complemento')->size(2);
        CRUD::column('numero')->size(2);
    }
}
