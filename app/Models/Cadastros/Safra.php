<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class Safra extends Model
{
    use HasFactory, SoftDeletes;

    use CrudTrait;
    use HasFactory, SoftDeletes;
    use LogsActivity;
    use Uuid;
    use Empresa;


     // Gravação do Log
   protected static $logName = 'Safra'; // Nome do Log
   protected static $logAttributes = ['*']; // Pega todos os campos da entidade
   protected static $logOnlyDirty = true;
   protected static $submitEmptyLogs = false;

   // Define o nome da tabela
   protected $table = 'safras';

   // Chave Primaria
   protected $primaryKey = 'id';

   
   //Define os campos da entidade
   protected $fillable = [
        'tenant_id',
        'uuid',
        'nome',
        'data_inicio',
        'data_final',
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
        'data_inicio' => 'date',
        'data_final' => 'date',
    ];


    public function tenant()
    {
        return $this->belongsTo(\App\Models\Cadastros\Tenant::class);
    }
}
