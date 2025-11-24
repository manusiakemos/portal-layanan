<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IntegrasiSmartDesaResource\Pages;
use App\Models\IntegrasiSmartDesa;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class IntegrasiSmartDesaResource extends Resource
{
    protected static ?string $model = IntegrasiSmartDesa::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Fitur Portal';
    protected static ?string $navigationLabel = 'Integrasi SmartDesa';
    protected static ?int $navigationSort = 1;

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
            'index' => Pages\ListIntegrasiSmartDesas::route('/'),
            'create' => Pages\CreateIntegrasiSmartDesa::route('/create'),
            'edit' => Pages\EditIntegrasiSmartDesa::route('/{record}/edit'),
        ];
    }
}
