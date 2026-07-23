<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gestion extends Model
{
    use HasFactory;

    protected $table = 'gestiones';

    protected $fillable = [
        'anio',
        'etapa',
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'anio' => 'integer',
    ];

    // Relación: una gestión tiene muchos cursos
    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

    // Scope: solo gestiones activas
    public function scopeActivas($query)
    {
        return $query->where('estado', 'Activo');
    }

    // Scope: filtrar por año
    public function scopePorAnio($query, $anio)
    {
        return $query->where('anio', $anio);
    }

    // Verificar si está activa
    public function estaActiva(): bool
    {
        return $this->estado === 'Activo';
    }

    // Nombre legible
    public function getNombreCompletoAttribute(): string
    {
        return "Gestión {$this->anio}" . ($this->etapa ? " - {$this->etapa}" : '');
    }
}