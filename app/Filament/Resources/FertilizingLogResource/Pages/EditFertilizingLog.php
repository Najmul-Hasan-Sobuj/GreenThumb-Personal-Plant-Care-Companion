<?php

namespace App\Filament\Resources\FertilizingLogResource\Pages;

use App\Filament\Resources\FertilizingLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFertilizingLog extends EditRecord
{
    protected static string $resource = FertilizingLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
