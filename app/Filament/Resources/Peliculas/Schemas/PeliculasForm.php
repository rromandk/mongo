<?php

namespace App\Filament\Resources\Peliculas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\RichContentAttribute;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ImageEntry;

class PeliculasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->label('Título'),
                Select::make('year')->label('Año')->options(array_combine(
                    range(1500, date('Y')),
                    range(1500, date('Y'))
                )),
                RichEditor::make('fullplot')->label('Sinopsis'),
                ImageEntry::make('poster')->label('Poster')->height(200),
                Select::make('genres')
                        ->label('Géneros')
                        ->multiple()
                        ->options([
                            'Action' => 'Action',
                            'Comedy' => 'Comedy',
                            'Drama' => 'Drama',
                            'Western' => 'Western',
                            'Short' => 'Short',
                            'Horror' => 'Horror',
                        ]),
                TextEntry::make('languages')->label('Idiomas')->formatStateUsing(function ($state) {
                    if (is_array($state)) {
                        return implode(', ', $state);
                    }
                    return $state ?? '-';
                }),
                TextEntry::make('released')->label('Lanzamiento')->date('d/m/Y'),
                TextEntry::make('directors')->label('Dirigida por')->formatStateUsing(function ($state) {
                    if (is_array($state)) {
                        return implode(', ', $state);
                    }
                    return $state ?? '-';
                }),
                TextEntry::make('imdb.rating')->label('⭐ Rating'),
                TextEntry::make('imdb.votes')->label('🗳 Votos'),
                TextEntry::make('imdb.id')
                    ->label('Ver en IMDb')
                    ->url(fn ($state) => $state ? "https://www.imdb.com/title/tt{$state}/" : null)
                    ->openUrlInNewTab(),
            ]);
    }
}
