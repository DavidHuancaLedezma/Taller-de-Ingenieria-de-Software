<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoEmpresa extends Model
{
    use HasFactory;

    // Nombre de la tabla (si no sigue la convención de nombres de Laravel)
    protected $table = 'grupo_empresa';

    // Indicar que la clave primaria no se llama 'id', sino 'id_grupo_empresa'
    protected $primaryKey = 'id_grupo_empresa';

    // Indicar que la clave primaria es de tipo int (automáticamente es un integer)
    public $incrementing = true;
    protected $keyType = 'int';

    // Indicar que las marcas de tiempo (created_at, updated_at) están activadas
    public $timestamps = true;

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'codigo_acceso',
        'nombre_largo',
        'nombre_corto',
        'direccion',
        'correo_electronico_ge',
        'telefono_ge'
    ];
}
