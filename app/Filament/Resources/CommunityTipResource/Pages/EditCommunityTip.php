<?php

namespace App\Filament\Resources\CommunityTipResource\Pages;

use App\Filament\Resources\CommunityTipResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommunityTip extends EditRecord
{
    protected static string $resource = CommunityTipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
