<?php

namespace App\Filament\Resources\PlantIssueResource\Pages;

use App\Filament\Resources\PlantIssueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlantIssue extends EditRecord
{
    protected static string $resource = PlantIssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
