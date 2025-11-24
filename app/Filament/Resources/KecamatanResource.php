<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kecamatan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use App\Filament\Resources\KecamatanResource\ManageKecamatanResource;

class KecamatanResource extends Resource
{
    protected static ?string $model = Kecamatan::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen E-Gov';
    protected static ?string $navigationLabel = 'Manajemen Kecamatan';    
    protected static ?int $navigationSort = 4;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_kecamatan')
                    ->label('Kode Kemendagri')
                    ->string()
                    ->required(),
                TextInput::make('nama')
                    ->label('Nama Kecamatan')
                    ->string()
                    ->required(),                    
                Toggle::make('active')
                    ->label('Aktif')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([   
                TextColumn::make('no')
                    ->label('No')
                    ->searchable()
                    ->rowIndex(),         
                TextColumn::make('kode_kecamatan')
                    ->label('Kode Kemendagri')
                    ->searchable(),
                TextColumn::make('nama')
                    ->label('Nama Kecamatan')
                    ->searchable(),                
                ToggleColumn::make('active')
                    ->label('Aktif'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->label('Aksi')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }    

    public static function getPages(): array
    {
        return [
            'index' => ManageKecamatanResource::route('/'),            
        ];
    }
}
