<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoEmpresa extends Model
{
    protected $table = 'grupo_empresa';
    protected $primaryKey = 'id_grupo_empresa';
    public $timestamps = false;

    protected $fillable = ['codigo_acceso', 'nombre_largo', 'nombre_corto', 'direccion', 'correo_eletronico_ge', 'telefono_ge'];

    // Relación con Proyecto
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'id_grupo_empresa', 'id_grupo_empresa');
    }
}
