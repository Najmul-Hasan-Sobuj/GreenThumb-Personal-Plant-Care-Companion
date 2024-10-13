<?php

namespace App\Filament\Resources\CareLogResource\Pages;

use App\Filament\Resources\CareLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCareLog extends EditRecord
{
    protected static string $resource = CareLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
