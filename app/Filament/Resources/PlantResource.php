<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlantResource\Pages;
use App\Models\Plant;
use App\Models\PlantType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class PlantResource extends Resource
{
    protected static ?string $model = Plant::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('plant_type_id')
                    ->label('Plant Type')
                    ->relationship('plantType', 'scientific_name')
                    ->preload()
                    ->required()
                    ->searchable(),
                DatePicker::make('acquired_date'),
                TextInput::make('location')
                    ->maxLength(255),
                Textarea::make('notes'),
                DatePicker::make('last_fertilized'),
                DatePicker::make('last_watered'),
                Select::make('current_health_status')
                    ->options([
                        'healthy' => 'Healthy',
                        'needs_attention' => 'Needs Attention',
                        'unhealthy' => 'Unhealthy',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('plantType.scientific_name')
                    ->label('Scientific Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('plantType.common_name')
                    ->label('Common Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('plantType.care_difficulty')
                    ->label('Care Difficulty')
                    ->sortable(),
                TextColumn::make('acquired_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('last_fertilized')
                    ->date()
                    ->sortable(),
                TextColumn::make('last_watered')
                    ->date()
                    ->sortable(),
                TextColumn::make('current_health_status')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('plant_type')
                    ->relationship('plantType', 'scientific_name'),
                SelectFilter::make('care_difficulty')
                    ->relationship('plantType', 'care_difficulty')
                    ->options([
                        'Easy' => 'Easy',
                        'Moderate' => 'Moderate',
                        'Difficult' => 'Difficult',
                    ]),
                SelectFilter::make('current_health_status')
                    ->options([
                        'healthy' => 'Healthy',
                        'needs_attention' => 'Needs Attention',
                        'unhealthy' => 'Unhealthy',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPlants::route('/'),
            'create' => Pages\CreatePlant::route('/create'),
            'view' => Pages\ViewPlant::route('/{record}'),
            'edit' => Pages\EditPlant::route('/{record}/edit'),
        ];
    }
}
