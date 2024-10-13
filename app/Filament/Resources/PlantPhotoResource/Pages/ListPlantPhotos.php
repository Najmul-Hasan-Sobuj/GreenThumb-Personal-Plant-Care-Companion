<?php

namespace App\Filament\Resources\PlantPhotoResource\Pages;

use App\Filament\Resources\PlantPhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlantPhotos extends ListRecords
{
    protected static string $resource = PlantPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
