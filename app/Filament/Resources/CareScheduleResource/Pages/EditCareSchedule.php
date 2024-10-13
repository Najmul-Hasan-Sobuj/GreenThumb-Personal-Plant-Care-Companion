<?php

namespace App\Filament\Resources\CareScheduleResource\Pages;

use App\Filament\Resources\CareScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCareSchedule extends EditRecord
{
    protected static string $resource = CareScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
