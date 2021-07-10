<?php

namespace App\Models\Cadastros;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InscricaoEstadual extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'fazenda_id',
        'proprietario_id',
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
}
