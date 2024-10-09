<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $table = 'objetivo';
    protected $primaryKey = 'id_objetivo';
    public $timestamps = false;

    protected $fillable = ['id_proyecto', 'id_hito', 'descrip_objetivo', 'prioridad', 'fecha_ini_objetivo', 'fecha_fin_objetivo'];

    // Relación con Hito
    public function hito()
    {
        return $this->belongsTo(Hito::class, 'id_hito', 'id_hito');
    }
}
