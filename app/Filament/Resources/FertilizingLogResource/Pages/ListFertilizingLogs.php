<?php

namespace App\Filament\Resources\FertilizingLogResource\Pages;

use App\Filament\Resources\FertilizingLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFertilizingLogs extends ListRecords
{
    protected static string $resource = FertilizingLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
