<?php
namespace App\Filament\Resources\MessageResource; 

use App\Filament\Resources\Messages\MessageResource;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;  
use Filament\Actions\DeleteAction;  
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\FileUpload;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

// campos
    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('nombre')
                ->required()
                ->maxLength(255),
            FileUpload::make('ruta')
            ->label('Archivo')
            ->disk('local')                // storage/app/public
            ->directory('documents')        // carpeta
            //->visibility('public')   //cualquiera con el link puede ver el archivo
            ->visibility('private')   //NO hace seguro el disk public NO es accesible directamente por URL por lo cual  necesitás un endpoint controlado (controller)
            ->acceptedFileTypes([
                'application/pdf',
                'image/*',
            ])
            ->maxSize(2048) // KB = 2MB
            ->required(),
        ]);
    }


// listado
    public function table(Table $table): Table
    {
         return $table
            ->columns([
                TextColumn::make('nombre'),
                TextColumn::make('ruta')
                ->label('Archivo')
                ->formatStateUsing(fn ($state) => 'Ver archivo')
                ->url(fn ($record) => route('documents.download', $record->id))
                ->openUrlInNewTab(),
            ])
            ->recordActions([
                ViewAction::make(),   // 👈 Agrega esto (botón de ver)
                EditAction::make(),
                DeleteAction::make(), // 👈 Opcional: botón de eliminar individual
            ])
            ->headerActions([
                CreateAction::make()->mutateFormDataUsing(function (array $data): array {
             
            $data['user_id'] = Auth::id(); // 👈 ACA SI FUNCIONA
            return $data;
        }),
                
            ]);
    }

      // ✅ MUTATE funciona en RelationManager
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        dd('ENTRO');
        // Asignar el user_id automáticamente
        $data['user_id'] = Auth::id();  // El ID del usuario dueño
        
        return $data;
    }

      // También para update
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Prevenir que cambien el user_id
        unset($data['user_id']);
        
        return $data;
    }

}