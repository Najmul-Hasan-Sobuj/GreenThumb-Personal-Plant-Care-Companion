<?php

namespace App\Filament\Resources\GrowthRecordResource\Pages;

use App\Filament\Resources\GrowthRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGrowthRecords extends ListRecords
{
    protected static string $resource = GrowthRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
