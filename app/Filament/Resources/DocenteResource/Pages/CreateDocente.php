<?php

namespace App\Filament\Resources\DocenteResource\Pages;

use App\Filament\Resources\DocenteResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateDocente extends CreateRecord
{
    protected static string $resource = DocenteResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $user = User::create([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'password' => $data['user']['password'],
            'rol' => 'docente',
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