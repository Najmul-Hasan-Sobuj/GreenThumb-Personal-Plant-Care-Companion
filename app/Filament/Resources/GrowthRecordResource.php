<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GrowthRecordResource\Pages;
use App\Models\GrowthRecord;
use App\Models\Plant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Carbon\Carbon;

class GrowthRecordResource extends Resource
{
    protected static ?string $model = GrowthRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Growth Records';

    protected static ?string $modelLabel = 'Growth Record';

    protected static ?string $navigationGroup = 'Plant Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('plant_id')
                    ->label('Plant')
                    ->relationship('plant', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('measurement_date')
                    ->required(),
                Forms\Components\TextInput::make('height')
                    ->numeric()
                    ->step(0.01)
                    ->suffix('cm'),
                Forms\Components\TextInput::make('width')
                    ->numeric()
                    ->step(0.01)
                    ->suffix('cm'),
                Forms\Components\TextInput::make('num_leaves')
                    ->numeric()
                    ->integer(),
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
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('measurement_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('height')
                    ->numeric(2)
                    ->sortable()
                    ->suffix('cm'),
                Tables\Columns\TextColumn::make('width')
                    ->numeric(2)
                    ->sortable()
                    ->suffix('cm'),
                Tables\Columns\TextColumn::make('num_leaves')
                    ->numeric()
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
                Tables\Filters\SelectFilter::make('plant')
                    ->relationship('plant', 'name'),
                Filter::make('measurement_date')
                    ->form([
                        Forms\Components\DatePicker::make('measured_from'),
                        Forms\Components\DatePicker::make('measured_until')->default(now()),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['measured_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('measurement_date', '>=', $date),
                            )
                            ->when(
                                $data['measured_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('measurement_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['measured_from'] ?? null) {
                            $indicators['measured_from'] = 'Measured from ' . Carbon::parse($data['measured_from'])->toFormattedDateString();
                        }

                        if ($data['measured_until'] ?? null) {
                            $indicators['measured_until'] = 'Measured until ' . Carbon::parse($data['measured_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
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
            'index' => Pages\ListGrowthRecords::route('/'),
            'create' => Pages\CreateGrowthRecord::route('/create'),
            'edit' => Pages\EditGrowthRecord::route('/{record}/edit'),
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
