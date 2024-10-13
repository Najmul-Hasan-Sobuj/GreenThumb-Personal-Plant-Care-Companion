<?php

namespace App\Filament\Resources\PlantResource\Pages;

use App\Filament\Resources\PlantResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;

class ViewPlant extends ViewRecord
{
    protected static string $resource = PlantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Plant Details')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Plant Name'),
                        TextEntry::make('user.name')
                            ->label('Owner'),
                        TextEntry::make('plantType.name')
                            ->label('Plant Type'),
                        TextEntry::make('acquired_date')
                            ->date(),
                        TextEntry::make('location'),
                    ])->columns(2),

                Section::make('Care Information')
                    ->schema([
                        TextEntry::make('last_watered')
                            ->date(),
                        TextEntry::make('last_fertilized')
                            ->date(),
                        TextEntry::make('current_health_status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'healthy' => 'success',
                                'needs_attention' => 'warning',
                                'unhealthy' => 'danger',
                                default => 'secondary',
                            }),
                    ])->columns(2),

                Section::make('Additional Information')
                    ->schema([
                        TextEntry::make('notes')
                            ->markdown()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
