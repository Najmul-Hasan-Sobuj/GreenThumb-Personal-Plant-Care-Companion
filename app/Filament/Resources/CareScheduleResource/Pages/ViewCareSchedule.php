<?php

namespace App\Filament\Resources\CareScheduleResource\Pages;

use App\Filament\Resources\CareScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;

class ViewCareSchedule extends ViewRecord
{
    protected static string $resource = CareScheduleResource::class;

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
                Section::make('Care Schedule Details')
                    ->schema([
                        TextEntry::make('plant.name')
                            ->label('Plant Name'),
                        TextEntry::make('care_type')
                            ->label('Care Type'),
                        TextEntry::make('frequency')
                            ->label('Frequency')
                            ->suffix(fn($record) => $record->frequency_unit),
                        TextEntry::make('last_performed_date')
                            ->date()
                            ->label('Last Performed'),
                        TextEntry::make('next_due_date')
                            ->date()
                            ->label('Next Due Date'),
                    ])->columns(2),

                Section::make('Additional Care Information')
                    ->schema([
                        TextEntry::make('notes')
                            ->markdown()
                            ->label('Notes')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
