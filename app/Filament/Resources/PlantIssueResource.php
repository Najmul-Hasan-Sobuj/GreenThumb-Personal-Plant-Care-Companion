<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlantIssueResource\Pages;
use App\Models\PlantIssue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PlantIssueResource extends Resource
{
    protected static ?string $model = PlantIssue::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle'; // Use a relevant icon

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('plant_id')
                    ->relationship('plant', 'name') // Assuming a 'plant' relationship
                    ->required()
                    ->label('Plant'),
                Forms\Components\TextInput::make('issue_type')
                    ->required()
                    ->label('Issue Type')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('Description'),
                Forms\Components\DatePicker::make('identified_date')
                    ->required()
                    ->label('Identified Date'),
                Forms\Components\DatePicker::make('resolved_date')
                    ->label('Resolved Date')
                    ->nullable(),
                Forms\Components\Textarea::make('resolution_notes')
                    ->label('Resolution Notes')
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
                Tables\Columns\TextColumn::make('issue_type')
                    ->label('Issue Type')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('identified_date')
                    ->label('Identified Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('resolved_date')
                    ->label('Resolved Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),
                Tables\Columns\TextColumn::make('resolution_notes')
                    ->label('Resolution Notes')
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('issue_type')
                    ->label('Issue Type')
                    ->form([
                        Forms\Components\TextInput::make('issue_type')->label('Issue Type'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['issue_type'], fn($q) => $q->where('issue_type', 'like', '%' . $data['issue_type'] . '%'));
                    }),
                Tables\Filters\Filter::make('identified_date')
                    ->label('Identified Date')
                    ->form([
                        Forms\Components\DatePicker::make('start')->label('Start Date'),
                        Forms\Components\DatePicker::make('end')->label('End Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['start'], fn($q) => $q->whereDate('identified_date', '>=', $data['start']))
                            ->when($data['end'], fn($q) => $q->whereDate('identified_date', '<=', $data['end']));
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
            //            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlantIssues::route('/'),
            'create' => Pages\CreatePlantIssue::route('/create'),
            'edit' => Pages\EditPlantIssue::route('/{record}/edit'),
        ];
    }
}
