<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Plant;
use App\Models\CareLog;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CareLogResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CareLogResource\RelationManagers;

class CareLogResource extends Resource
{
    protected static ?string $model = CareLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Care Logs';

    protected static ?string $modelLabel = 'Care Log';

    protected static ?string $navigationGroup = 'Plant Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('plant_id')
                    ->label('Plant')
                    ->options(Plant::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('care_type')
                    ->options([
                        'Watering' => 'Watering',
                        'Fertilizing' => 'Fertilizing',
                        'Pruning' => 'Pruning',
                        'Repotting' => 'Repotting',
                        'Other' => 'Other',
                    ])
                    ->required(),
                DatePicker::make('performed_date')
                    ->required(),
                Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('plant.name')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('care_type')
                    ->searchable(),
                TextColumn::make('performed_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('notes')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('care_type')
                    ->options([
                        'Watering' => 'Watering',
                        'Fertilizing' => 'Fertilizing',
                        'Pruning' => 'Pruning',
                        'Repotting' => 'Repotting',
                        'Other' => 'Other',
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
            'index' => Pages\ListCareLogs::route('/'),
            'create' => Pages\CreateCareLog::route('/create'),
            'edit' => Pages\EditCareLog::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
