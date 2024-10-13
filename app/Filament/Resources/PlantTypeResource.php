<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlantTypeResource\Pages;
use App\Filament\Resources\PlantTypeResource\RelationManagers;
use App\Models\PlantType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlantTypeResource extends Resource
{
    protected static ?string $model = PlantType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('scientific_name')
                    ->required()
                    ->label('Scientific Name'),

                Forms\Components\TextInput::make('common_name')
                    ->label('Common Name')
                    ->nullable(),

                Forms\Components\Select::make('care_difficulty')
                    ->options([
                        'Easy' => 'Easy',
                        'Moderate' => 'Moderate',
                        'Difficult' => 'Difficult',
                    ])
                    ->required()
                    ->label('Care Difficulty'),

                Forms\Components\Textarea::make('light_requirements')
                    ->required()
                    ->label('Light Requirements'),

                Forms\Components\Textarea::make('water_requirements')
                    ->required()
                    ->label('Water Requirements'),

                Forms\Components\TextInput::make('temperature_range')
                    ->required()
                    ->label('Temperature Range'),

                Forms\Components\Textarea::make('humidity_requirements')
                    ->required()
                    ->label('Humidity Requirements'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('scientific_name')
                    ->label('Scientific Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('common_name')
                    ->label('Common Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('temperature_range')
                    ->label('Temperature Range'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('care_difficulty')
                    ->label('Care Difficulty')
                    ->options([
                        'Easy' => 'Easy',
                        'Moderate' => 'Moderate',
                        'Difficult' => 'Difficult',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPlantTypes::route('/'),
            'create' => Pages\CreatePlantType::route('/create'),
            'edit' => Pages\EditPlantType::route('/{record}/edit'),
            'view' => Pages\ViewPlantType::route('/{record}'),
        ];
    }
}
