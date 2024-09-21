<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteGrupoEmpresa extends Model
{
    protected $table = 'estudiante_grupoempresa';
    public $timestamps = false;
    protected $primaryKey = ['id_usuario', 'id_grupo_empresa']; // Llave compuesta

    protected $fillable = ['id_usuario', 'id_grupo_empresa', 'periodo_grupoempresa'];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Relación con GrupoEmpresa
    public function grupoEmpresa()
    {
        return $this->belongsTo(GrupoEmpresa::class, 'id_grupo_empresa', 'id_grupo_empresa');
    }
}
