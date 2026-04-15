<?php

namespace App\Filament\Resources\Peliculas;

use App\Filament\Resources\Peliculas\Pages\CreatePeliculas;
use App\Filament\Resources\Peliculas\Pages\EditPeliculas;
use App\Filament\Resources\Peliculas\Pages\ListPeliculas;
use App\Filament\Resources\Peliculas\Pages\ViewPeliculas;
use App\Filament\Resources\Peliculas\Schemas\PeliculasForm;
use App\Filament\Resources\Peliculas\Schemas\PeliculasInfolist;
use App\Filament\Resources\Peliculas\Tables\PeliculasTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Models\Peliculas; 
use App\Filament\Resources\Peliculas\RelationManagers\CommentsRelationManager;
class PeliculasResource extends Resource
{
    protected static ?string $model = Peliculas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return PeliculasForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PeliculasInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeliculasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPeliculas::route('/'),
            'create' => CreatePeliculas::route('/create'),
            'view' => ViewPeliculas::route('/{record}'),
            'edit' => EditPeliculas::route('/{record}/edit'),
        ];
    }
}
