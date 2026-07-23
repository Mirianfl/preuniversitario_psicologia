<?php

namespace App\Filament\Resources\EstudianteResource\Pages;

use App\Filament\Resources\EstudianteResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEstudiante extends CreateRecord
{
    protected static string $resource = EstudianteResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $user = User::create([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'password' => $data['user']['password'],
            'rol' => 'estudiante',
        ]);

        return static::getModel()::create([
            'user_id' => $user->id,
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'ci' => $data['ci'] ?? null,
            'celular' => $data['celular'] ?? null,
        ]);
    }
}