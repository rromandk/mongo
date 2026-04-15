<?php

namespace App\Filament\Resources\Peliculas\Pages;

use App\Filament\Resources\Peliculas\PeliculasResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPeliculas extends ViewRecord
{
    protected static string $resource = PeliculasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
