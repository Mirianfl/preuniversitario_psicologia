<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstudianteResource\Pages;
use App\Models\Estudiante;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class EstudianteResource extends Resource
{
    protected static ?string $model = Estudiante::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Estudiantes';
    protected static ?string $pluralLabel = 'Estudiantes';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Datos de Usuario')
                ->schema([
                    Forms\Components\TextInput::make('user.name')
                        ->label('Nombre de usuario')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('user.email')
                        ->label('Email')
                        ->email()
                        ->required(),
                    Forms\Components\TextInput::make('user.password')
                        ->label('Contraseña')
                        ->password()
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context): bool => $context === 'create'),
                ]),
            
            Forms\Components\Section::make('Datos Personales')
                ->schema([
                    Forms\Components\TextInput::make('nombre')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('apellidos')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('ci')
                        ->label('C.I.')
                        ->maxLength(20),
                    Forms\Components\TextInput::make('celular')
                        ->tel()
                        ->maxLength(20),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('nombre_completo')
                    ->label('Nombre')
                    ->searchable(['nombre', 'apellidos']),
                Tables\Columns\TextColumn::make('ci')->label('C.I.'),
                Tables\Columns\TextColumn::make('celular'),
                Tables\Columns\TextColumn::make('user.email')->label('Email'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstudiantes::route('/'),
            'create' => Pages\CreateEstudiante::route('/create'),
            'edit' => Pages\EditEstudiante::route('/{record}/edit'),
        ];
    }
}