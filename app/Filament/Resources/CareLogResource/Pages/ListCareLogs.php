<?php

namespace App\Filament\Resources\CareLogResource\Pages;

use App\Filament\Resources\CareLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareLogs extends ListRecords
{
    protected static string $resource = CareLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
