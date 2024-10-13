<?php

namespace App\Filament\Resources\PlantTypeResource\Pages;

use App\Filament\Resources\PlantTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPlantType extends ViewRecord
{
    protected static string $resource = PlantTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
