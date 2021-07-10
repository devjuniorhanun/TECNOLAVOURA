<?php

namespace App\Http\Controllers\Admin\Cadastros;

use App\Http\Requests\Cadastros\TalhaoRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TalhaoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TalhaoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cadastros\Talhao::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cadastros/talhao');
        CRUD::setEntityNameStrings('Talhão', 'Talhões');
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
        CRUD::column('fazenda_id')
            ->label('Fazenda.:')
            ->type('select')
            ->entity('Fazenda')
            ->attribute('nome')
            ->size(4);
        CRUD::column('nome')->label('Talhão.:');
        CRUD::column('area_total')
            ->label('Área Total.:')
            ->size(2)
            ->type('number')
            ->decimals(2)
            ->suffix(' ha')
            ->dec_point(',')
            ->thousands_sep('.');;
        CRUD::column('bloco')->label('Bloco.:');
        CRUD::column('status')->label('Status.:')->type('enum');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TalhaoRequest::class);

        CRUD::field('fazenda_id')
            ->type('select2')
            ->entity('fazenda')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->orderBy('nome', 'ASC')->get();
            })
            ->size(4)->attributes(['id' => 'fazenda_id']);

        CRUD::field('nome')->label('Talhão.:')->size(3)->attributes(['id' => 'nomeTalhao']);
        CRUD::field('area_total')->label('Área Total.:')->size(2)->attributes(['class' => 'form-control areas']);
        CRUD::field('bloco')->label('Bloco.:')->size(1);
        CRUD::field('status')->label('Status.:')->type('enum')->size(2);
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


    public function areaTalhao()
    {
        
    }
}
