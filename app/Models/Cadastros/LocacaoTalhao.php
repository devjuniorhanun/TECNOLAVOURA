<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class LocacaoTalhao extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;


    // Gravação do Log
    protected static $logName = 'LocacaoTalhao'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'locacao_talhaos';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'safra_id',
        'ano_agricola_id',
        'cultura_id',
        'variedade_cultura_id',
        'talhao_id',
        'uuid',
        'area_plantada',
        'semente_linear',
        'semente_populacao',
        'inicio_plantio',
        'final_plantio',
        'data_prevista',
        'observacoes',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tenant_id' => 'integer',
        'ano_agricola_id' => 'integer',
        'safra_id' => 'integer',
        'cultura_id' => 'integer',
        'variedade_cultura_id' => 'integer',
        'talhao_id' => 'integer',
        'area_plantada' => 'double',
        'inicio_plantio' => 'date',
        'final_plantio' => 'date',
        'data_prevista' => 'date',
    ];


    public function tenant()
    {
        return $this->belongsTo(\App\Models\Cadastros\Tenant::class);
    }

    public function safra()
    {
        return $this->belongsTo(\App\Models\Cadastros\Safra::class);
    }

    public function cultura()
    {
        return $this->belongsTo(\App\Models\Cadastros\Cultura::class);
    }

    public function variedadeCultura()
    {
        return $this->belongsTo(\App\Models\Cadastros\VariedadeCultura::class);
    }

    public function talhao()
    {
        return $this->belongsTo(\App\Models\Cadastros\Talhao::class);
    }
}
