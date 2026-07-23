<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'apellidos',
        'ci',
        'celular',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellidos}";
    }
}