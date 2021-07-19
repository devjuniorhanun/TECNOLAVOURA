<?php

namespace App\Http\Controllers\Admin\Cadastros;

use App\Http\Requests\Cadastros\InscricaoEstadualRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class InscricaoEstadualCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InscricaoEstadualCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cadastros\InscricaoEstadual::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cadastros/inscricao-estadual');
        CRUD::setEntityNameStrings('Inscrição Estadual', 'Inscrições Estaduais');
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
        CRUD::column('produtor_id')->type('relationship')
            ->name('produtor_id')
            ->entity('produtor')
            ->attribute('razao_social')
            ->size(4);
        CRUD::column('proprietario_id')->type('select')
            ->entity('Proprietario')
            ->attribute('razao_social')
            ->size(4);

        CRUD::column('fazenda_id')
            ->label('Fazenda.:')
            ->type('select')
            ->entity('Fazenda')
            ->attribute('nome')
            ->size(4);
        CRUD::column('inscricao')->label('Inscrição.:');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(InscricaoEstadualRequest::class);

        CRUD::field('produtor_id')
            ->type('select2')
            ->entity('produtors')
            
            ->options(function ($query) {
                return $query->leftJoin('proprietarios','proprietarios.id','produtors.proprietario_id')->orderBy('proprietarios.nome_fantasia', 'ASC')->select('proprietarios.nome_fantasia as nomeTe')->get();
            })
            ->attribute('nomeTe')
            ->size(4);
        CRUD::field('proprietario_id')
            ->type('select2')
            ->entity('proprietario')
            ->attribute('nome_fantasia')
            ->options(function ($query) {
                return $query->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(4);

        CRUD::field('fazenda_id')
            ->type('select2')
            ->entity('fazenda')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->orderBy('nome', 'ASC')->get();
            })
            ->size(4)->attributes(['id' => 'fazenda_id']);
        CRUD::field('inscricao')->label('Inscrição.:')->size(3);
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
