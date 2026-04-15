<?php

namespace App\Filament\Resources\Peliculas\Pages;

use App\Filament\Resources\Peliculas\PeliculasResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPeliculas extends EditRecord
{
    protected static string $resource = PeliculasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
