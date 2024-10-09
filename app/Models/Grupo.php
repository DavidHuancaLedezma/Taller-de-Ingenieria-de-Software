<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupo';
    protected $primaryKey = 'id_grupo';
    public $timestamps = false;

    protected $fillable = ['nombre_grupo'];

    // Relación con Proyecto
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'id_grupo', 'id_grupo');
    }
}
