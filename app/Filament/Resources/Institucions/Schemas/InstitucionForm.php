<?php

namespace App\Filament\Resources\Institucions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InstitucionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('direccion')
                    ->default(null),
                TextInput::make('telefono')
                    ->tel()
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('sitio_web')
                    ->default(null),
                Textarea::make('descripcion')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
