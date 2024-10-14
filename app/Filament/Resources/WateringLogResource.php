<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WateringLogResource\Pages;
use App\Filament\Resources\WateringLogResource\RelationManagers;
use App\Models\WateringLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WateringLogResource extends Resource
{
    protected static ?string $model = WateringLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('plant_id')
                    ->relationship('plant', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('watering_date')
                    ->required(),
                Forms\Components\TextInput::make('water_amount')
                    ->numeric()
                    ->step(0.01)
                    ->suffix('L'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('plant.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('watering_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('water_amount')
                    ->numeric()
                    ->suffix('L')
                    ->sortable(),
                Tables\Columns\TextColumn::make('notes')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListWateringLogs::route('/'),
            'create' => Pages\CreateWateringLog::route('/create'),
            'edit' => Pages\EditWateringLog::route('/{record}/edit'),
        ];
    }
}
