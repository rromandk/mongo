<?php

namespace App\Filament\Resources\Institucions\Pages;

use App\Filament\Resources\Institucions\InstitucionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ShowInstitucion extends ViewRecord
{
    protected static string $resource = InstitucionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
