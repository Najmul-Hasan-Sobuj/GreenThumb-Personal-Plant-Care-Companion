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
            'index' => Pages\ListWateringLogs::route('/'),
            'create' => Pages\CreateWateringLog::route('/create'),
            'edit' => Pages\EditWateringLog::route('/{record}/edit'),
        ];
    }
}
