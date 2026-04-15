<?php

namespace App\Filament\Resources\Messages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class MessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('asunto')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fecha')
                    ->searchable()
                    ->date('d/m/y'),
                TextColumn::make('mensaje')
                    ->html()
                    ->limit(100),
                TextColumn::make('user_name') //Laravel convierte eso en: getUserNameAttribute
                    ->label('Usuario')
            ])
            ->filters([
                //
            ])
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