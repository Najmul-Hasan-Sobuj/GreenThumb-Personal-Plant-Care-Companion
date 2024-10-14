<?php

namespace App\Filament\Resources\PlantPhotoResource\Pages;

use App\Filament\Resources\PlantPhotoResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Filament\Actions;

class ViewPlantPhoto extends ViewRecord
{
    protected static string $resource = PlantPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->color('warning'),
            Actions\DeleteAction::make()->color('danger'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                ImageEntry::make('photo_url')
                                    ->label('Photo')
                                    ->height(400)
                                    ->extraAttributes([
                                        'class' => 'rounded-lg shadow-lg cursor-pointer',
                                        'x-on:click' => '$dispatch("open-modal", { id: "fullscreen-photo" })',
                                    ]),
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('plant.name')
                                            ->label('Plant')
                                            ->weight('bold')
                                            ->color('success')
                                            ->icon('heroicon-o-adjustments-vertical'),
                                        TextEntry::make('taken_date')
                                            ->label('Date Taken')
                                            ->date()
                                            ->icon('heroicon-o-calendar'),
                                        TextEntry::make('notes')
                                            ->label('Notes')
                                            ->markdown()
                                            ->icon('heroicon-o-chat-bubble-left-ellipsis')
                                            ->columnSpanFull(),
                                        TextEntry::make('created_at')
                                            ->label('Added on')
                                            ->dateTime()
                                            ->icon('heroicon-o-clock')
                                            ->color('gray'),
                                    ])
                                    ->columnSpan(1),
                            ]),
                    ])
                    ->columns(2)
                    ->extraAttributes([
                        'class' => 'bg-white rounded-xl shadow-sm p-6',
                    ]),
                Section::make('Related Photos')
                    ->schema([
                        // Add a grid or carousel of related photos here
                    ])
                    ->collapsible(),
            ]);
    }

    public function getModalContent(): array
    {
        return [
            'fullscreen-photo' => [
                'title' => 'Full Size Photo',
                'content' => ImageEntry::make('photo_url')
                    ->label('')
                    ->height(600),
            ],
        ];
    }
}