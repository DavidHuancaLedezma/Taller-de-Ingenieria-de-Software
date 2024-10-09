<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlSemanal extends Model
{
    protected $table = 'control_semanal';
    protected $primaryKey = 'id_control_semanal';
    public $timestamps = false;

    protected $fillable = ['id_usuario', 'id_grupo_empresa', 'id_hito', 'id_actividad'];

    // Relación con Actividad
    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'id_actividad', 'id_actividad');
    }
}
