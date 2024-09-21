<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterioAceptacion extends Model
{
    protected $table = 'criterio_aceptacion';
    protected $primaryKey = ['id_objetivo', 'id_criterio_aceptacion']; // Llave compuesta
    public $timestamps = false;

    protected $fillable = ['id_objetivo', 'descripcion_ca', 'cumplido'];

    // Relación con Objetivo
    public function objetivo()
    {
        return $this->belongsTo(Objetivo::class, 'id_objetivo', 'id_objetivo');
    }
}
