<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GrowthRecordResource\Pages;
use App\Filament\Resources\GrowthRecordResource\RelationManagers;
use App\Models\GrowthRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GrowthRecordResource extends Resource
{
    protected static ?string $model = GrowthRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
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
}
