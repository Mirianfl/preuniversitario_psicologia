<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gestion extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'gestiones';  // Cambiado a plural como está en tu migración

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'anio',
        'etapa',
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'anio' => 'integer',
    ];

    /**
     * Los atributos que deben ser ocultados para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Relación: Una gestión tiene muchos cursos.
     */
    public function cursos()
    {
        return $this->hasMany(Curso::class, 'id_gestion');
    }

    /**
     * Scope para filtrar gestiones activas.
     */
    public function scopeActivas($query)
    {
        return $query->where('estado', 'Activo');
    }

    /**
     * Scope para filtrar por año.
     */
    public function scopePorAnio($query, $anio)
    {
        return $query->where('anio', $anio);
    }

    /**
     * Verificar si la gestión está activa.
     */
    public function estaActiva(): bool
    {
        return $this->estado === 'Activo';
    }

    /**
     * Obtener el nombre completo de la gestión.
     */
    public function getNombreCompletoAttribute(): string
    {
        return "Gestión {$this->anio}" . ($this->etapa ? " - {$this->etapa}" : '');
    }
}