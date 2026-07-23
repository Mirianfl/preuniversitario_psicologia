<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docente extends Model
{
    use HasFactory;
    //ya no es necesario por que 
    protected $table = 'Docentes';

    protected $fillable = [
        'user_id',
        'nombre',
        'apellidos',
        'ci',
        'celular',
    ];

    // Un docente pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un docente imparte muchas materias
    public function materias()
    {
        return $this->hasMany(Materia::class);
    }

    // Un docente crea muchas lecciones
    public function lecciones()
    {
        return $this->hasMany(Leccion::class);
    }

    // Helper: nombre completo
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellidos}";
    }
}