<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;  
use Filament\Actions\DeleteAction;  
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;


class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
/*                TextColumn::make('role_id')
                    ->numeric()
                    ->sortable(),
               TextColumn::make('role.name') // 👈 CLAVE
                ->label('Rol')
                ->sortable()
                ->searchable(), */
                BadgeColumn::make('role.name')
    ->label('Rol')
    ->colors([
        'primary' => 'Admin',
        'success' => 'User',
    ]),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),   // 👈 Agrega esto (botón de ver)
                EditAction::make(),
                DeleteAction::make(), // 👈 Opcional: botón de eliminar individual
                        ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
