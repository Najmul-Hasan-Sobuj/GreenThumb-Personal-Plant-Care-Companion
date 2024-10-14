<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareScheduleResource\Pages;
use App\Models\CareSchedule;
use App\Notifications\CareScheduleNotification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class CareScheduleResource extends Resource
{
    protected static ?string $model = CareSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('plant_id')
                    ->relationship('plant', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),
                Select::make('care_type')
                    ->options([
                        'Watering' => 'Watering',
                        'Fertilizing' => 'Fertilizing',
                        'Pruning' => 'Pruning',
                        'Repotting' => 'Repotting',
                    ])
                    ->required(),
                TextInput::make('frequency')
                    ->numeric()
                    ->required()
                    ->label('Frequency (e.g., 3, 7)'),
                Select::make('frequency_unit')
                    ->options([
                        'Days' => 'Days',
                        'Weeks' => 'Weeks',
                        'Months' => 'Months',
                    ])
                    ->required(),
                DatePicker::make('last_performed_date')
                    ->nullable(),
                DatePicker::make('next_due_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('plant.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('care_type')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('frequency')
                    ->label('Frequency'),
                TextColumn::make('frequency_unit')
                    ->label('Unit'),
                TextColumn::make('last_performed_date')
                    ->date(),
                TextColumn::make('next_due_date')
                    ->date(),
            ])
            ->filters([
                SelectFilter::make('care_type'),
                SelectFilter::make('frequency_unit'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCareSchedules::route('/'),
            'create' => Pages\CreateCareSchedule::route('/create'),
            'view' => Pages\ViewCareSchedule::route('/{record}'),
            'edit' => Pages\EditCareSchedule::route('/{record}/edit'),
        ];
    }
}
