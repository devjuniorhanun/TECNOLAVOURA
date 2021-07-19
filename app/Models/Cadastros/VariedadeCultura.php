<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class VariedadeCultura extends Model
{
    use HasFactory, SoftDeletes;
    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;


    // Gravação do Log
    protected static $logName = 'VariedadeCulturas'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'variedade_culturas';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'ano_agricola_id',
        'cultura_id',
        'uuid',
        'nome',
        'tecnologia',
        'ciclo',
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
        'cultura_id' => 'integer',
    ];


    public function tenant()
    {
        return $this->belongsTo(\App\Models\Cadastros\Tenant::class);
    }

    public function cultura()
    {
        return $this->belongsTo(\App\Models\Cadastros\Cultura::class);
    }
}
