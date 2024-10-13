<?php

namespace App\Filament\Resources\CommunityTipResource\Pages;

use App\Filament\Resources\CommunityTipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommunityTips extends ListRecords
{
    protected static string $resource = CommunityTipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
