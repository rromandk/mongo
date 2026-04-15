<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Schemas\Schema;

class MessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                    \Filament\Forms\Components\TextInput::make('asunto')
                        ->required()
                        ->maxLength(255),
                    \Filament\Forms\Components\DatePicker::make('fecha'),
                    \Filament\Forms\Components\RichEditor::make('mensaje')
                        ->required()
                        ->extraInputAttributes(['style' => 'max-height: 400px; overflow-y: auto;'])
                        ->placeholder('Escribe tu mensaje...'),
            ]);
    }
}
