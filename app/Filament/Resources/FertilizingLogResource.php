<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FertilizingLogResource\Pages;
use App\Models\FertilizingLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FertilizingLogResource extends Resource
{
    protected static ?string $model = FertilizingLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('plant_id')
                    ->relationship('plant', 'name') // Assuming a 'plant' relationship
                    ->required()
                    ->label('Plant'),
                Forms\Components\DatePicker::make('fertilizing_date')
                    ->required()
                    ->label('Fertilizing Date'),
                Forms\Components\TextInput::make('fertilizer_type')
                    ->label('Fertilizer Type')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('amount')
                    ->label('Amount (kg)')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('plant.name')
                    ->label('Plant')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('fertilizing_date')
                    ->label('Fertilizing Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fertilizer_type')
                    ->label('Fertilizer Type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount (kg)')
                    ->sortable(),
                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('fertilizing_date')
                    ->label('Fertilizing Date')
                    ->form([
                        Forms\Components\DatePicker::make('start')->label('Start Date'),
                        Forms\Components\DatePicker::make('end')->label('End Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['start'], fn($q) => $q->whereDate('fertilizing_date', '>=', $data['start']))
                            ->when($data['end'], fn($q) => $q->whereDate('fertilizing_date', '<=', $data['end']));
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add any related models here if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFertilizingLogs::route('/'),
            'create' => Pages\CreateFertilizingLog::route('/create'),
            'edit' => Pages\EditFertilizingLog::route('/{record}/edit'),
        ];
    }
}
