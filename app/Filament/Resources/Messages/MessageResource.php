<?php

namespace App\Filament\Resources\Messages;

use App\Filament\Resources\Messages\Pages\CreateMessage;
use App\Filament\Resources\Messages\Pages\EditMessage;
use App\Filament\Resources\Messages\Pages\ListMessages;
use App\Filament\Resources\Messages\Pages\ViewMessage;
use App\Filament\Resources\Messages\Schemas\MessageForm;
use App\Filament\Resources\Messages\Schemas\MessageInfolist;
use App\Filament\Resources\Messages\Tables\MessagesTable;
use App\Models\Message;
use BackedEnum;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\MessageResource\DocumentsRelationManager;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;
    
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chat-bubble-left';
    
    protected static bool $shouldRegisterNavigation = true;
    
    protected static ?string $recordTitleAttribute = 'asunto';
    
    // ✅ MÉTODO CRÍTICO QUE FALTA
    public static function getModel(): string
    {
        return Message::class;
    }
    
    public static function getRelations(): array
    {
        return [
            DocumentsRelationManager::class,
        ];
    }

    // ✅ Previene que Filament intente obtener la tabla
    public static function getModelLabel(): string
    {
        return 'Mensaje';
    }
    
    public static function getPluralModelLabel(): string
    {
        return 'Mensajes';
    }
  
    public static function getNavigationBadge(): ?string
    {
        return null;
    }
    
    protected static function shouldCheckForRecordCount(): bool
    {
        return false;
    }
    
    // ✅ Sobrescribe el método que causa el error
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();
        
        // Evita cualquier operación que requiera SQL
        if (method_exists($query, 'withoutGlobalScopes')) {
            $query->withoutGlobalScopes();
        }
        
        return $query;
    }
    
    public static function form(Schema $schema): Schema
    {
        return MessageForm::configure($schema);
    }
    
    public static function table(Table $table): Table
    {
       return MessagesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMessages::route('/'),
            'create' => CreateMessage::route('/create'),
            'view' => ViewMessage::route('/{record}'),
            'edit' => EditMessage::route('/{record}/edit'),
        ];
    }
}
