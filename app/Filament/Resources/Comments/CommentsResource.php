<?php

namespace App\Filament\Resources\Comments;

use App\Filament\Resources\Comments\Pages\CreateComments;
use App\Filament\Resources\Comments\Pages\EditComments;
use App\Filament\Resources\Comments\Pages\ListComments;
use App\Filament\Resources\Comments\Pages\ViewComments;
use App\Filament\Resources\Comments\Schemas\CommentsForm;
use App\Filament\Resources\Comments\Schemas\CommentsInfolist;
use App\Filament\Resources\Comments\Tables\CommentsTable;
use App\Models\Comments;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CommentsResource extends Resource
{
    protected static ?string $model = Comments::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Comments';

    public static function form(Schema $schema): Schema
    {
        return CommentsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CommentsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComments::route('/'),
            'create' => CreateComments::route('/create'),
            'view' => ViewComments::route('/{record}'),
            'edit' => EditComments::route('/{record}/edit'),
        ];
    }
}
