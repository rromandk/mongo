<?php

namespace App\Filament\Resources\Peliculas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PeliculasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('title')
                ->label('Título')
                ->searchable(),
            TextColumn::make('year')
                ->label('Año')
                ->sortable(),
            TextColumn::make('comments_count')
                ->label('Comentarios')
                ->getStateUsing(fn ($record) => $record->comments()->count()),
            TextColumn::make('fullplot')
                ->label('Sinopsis')
                ->limit(50),
        ])
        //->defaultSort('title', 'asc')
          ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
