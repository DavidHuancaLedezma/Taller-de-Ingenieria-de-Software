<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    protected $table = 'usuario'; // Nombre de la tabla
    protected $primaryKey = 'id_usuario'; // Clave primaria
    public $timestamps = false; // Si la tabla no tiene timestamps (created_at y updated_at)

    protected $fillable = [
        'doc_id_usuario', 'est_id_usuario', 'nombre_usuario', 'contrasena',
        'correo_electronico_user', 'usuario_activo', 'telefono_usuario'
    ];

    // Relación con Estudiante
    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id_usuario', 'id_usuario');
    }

    // Relación con Docente
    public function docente()
    {
        return $this->hasOne(Docente::class, 'id_usuario', 'id_usuario');
    }
    public function getAuthPassword()
{
    return $this->contrasena; // Cambia "clave" por el nombre real del campo de contraseña
}
}
