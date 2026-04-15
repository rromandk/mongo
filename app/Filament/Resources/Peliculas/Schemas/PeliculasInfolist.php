<?php

namespace App\Filament\Resources\Peliculas\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ImageEntry;

class PeliculasInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')->label('Título'),
                TextEntry::make('year')->label('Año'),
                TextEntry::make('fullplot')->label('Sinopsis'),
                ImageEntry::make('poster')->label('Poster')->height(200),
                TextEntry::make('genres')->label('Géneros')->formatStateUsing(function ($state) {
                    if (is_array($state)) {
                        return implode(', ', $state);
                    }

                     return $state ?? '-';
                }),
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


