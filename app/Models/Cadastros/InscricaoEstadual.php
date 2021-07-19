<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class InscricaoEstadual extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;


    // Gravação do Log
    protected static $logName = 'InscricaoEstadual'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'inscricao_estaduals';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'fazenda_id',
        'proprietario_id',
        'produtor_id',
        'uuid',
        'inscricao',
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
        'fazenda_id' => 'integer',
        'proprietario_id' => 'integer',
        'produtor_id' => 'integer',
    ];


    public function tenant()
    {
        return $this->belongsTo(\App\Models\Cadastros\Tenant::class);
    }

    public function fazenda()
    {
        return $this->belongsTo(\App\Models\Cadastros\Fazenda::class);
    }

    public function proprietario()
    {
        return $this->belongsTo(\App\Models\Cadastros\Proprietario::class);
    }

    public function produtor()
    {
        return $this->belongsTo(\App\Models\Cadastros\Produtor::class,'produtor_id','id');
    }
}