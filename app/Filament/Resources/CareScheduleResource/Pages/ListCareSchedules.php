<?php

namespace App\Filament\Resources\CareScheduleResource\Pages;

use App\Filament\Resources\CareScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareSchedules extends ListRecords
{
    protected static string $resource = CareScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
