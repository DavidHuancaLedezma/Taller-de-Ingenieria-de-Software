<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hito extends Model
{
    protected $table = 'hito';
    protected $primaryKey = ['id_proyecto', 'id_hito']; // Llave compuesta
    public $timestamps = false;

    protected $fillable = ['id_proyecto', 'numero_hito', 'fecha_inicio_hito', 'fecha_fin_hito'];

    // Relación con Proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto', 'id_proyecto');
    }
      // Accessor para el campo 'NUMERO_HITO'
    public function getNumeroHitoAttribute($value)
    {
          return 'Hito ' . $value;
    }
    

}
