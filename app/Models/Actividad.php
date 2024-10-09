<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividad';
    protected $primaryKey = ['id_usuario', 'id_objetivo', 'id_actividad']; // Llave compuesta
    public $timestamps = false;

    protected $fillable = ['id_usuario', 'id_objetivo', 'descripcion_actividad', 'resultado', 'realizado'];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
