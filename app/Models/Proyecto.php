<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    protected $primaryKey = 'id_proyecto';
    public $timestamps = false;

    protected $fillable = ['id_grupo', 'id_grupo_empresa', 'nombre_proyecto', 'descripcion_proyecto', 'fecha_ini_proyecto', 'fecha_fin_proyecto'];

    // Relación con Grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo', 'id_grupo');
    }

    // Relación con GrupoEmpresa
    public function grupoEmpresa()
    {
        return $this->belongsTo(GrupoEmpresa::class, 'id_grupo_empresa', 'id_grupo_empresa');
    }
}
