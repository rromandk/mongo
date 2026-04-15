<?php

namespace App\Filament\Resources\Peliculas\Pages;

use App\Filament\Resources\Peliculas\PeliculasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPeliculas extends ListRecords
{
    protected static string $resource = PeliculasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
