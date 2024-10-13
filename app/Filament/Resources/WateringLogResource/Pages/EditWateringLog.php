<?php

namespace App\Filament\Resources\WateringLogResource\Pages;

use App\Filament\Resources\WateringLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWateringLog extends EditRecord
{
    protected static string $resource = WateringLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
