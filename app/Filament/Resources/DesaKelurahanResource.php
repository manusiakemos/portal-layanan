<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kecamatan;
use Filament\Tables\Table;
use App\Models\DesaKelurahan;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\BadgeColumn;
use App\Filament\Resources\DesaKelurahanResource\ManageDesaKelurahanResource;

class DesaKelurahanResource extends Resource
{
    protected static ?string $model = DesaKelurahan::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen E-Gov';
    protected static ?string $navigationLabel = 'Manajemen Desa dan Kelurahan';    
    protected static ?int $navigationSort = 5;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kecamatan_id')
                    ->label('Kecamatan')
                    ->options(
                        Kecamatan::query()
                            ->orderBy('nama')
                            ->get()
                            ->mapWithKeys(fn ($k) => [
                                $k->id => "{$k->kode_kecamatan} - {$k->nama}"
                            ])
                    )
                    ->searchable()
                    ->required(),

                TextInput::make('nama')
                    ->label('Nama Desa / Kelurahan')
                    ->required()
                    ->maxLength(255),

                Select::make('jenis')
                    ->options([
                        'Desa' => 'Desa',
                        'Kelurahan' => 'Kelurahan',
                    ])
                    ->required(),

                TextInput::make('kode_pos')
                    ->numeric()
                    ->maxLength(10)
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
                TextColumn::make('id')
                ->label('No')
                ->sortable(),

                TextColumn::make('kecamatan.nama')
                    ->label('Kecamatan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('jenis')
                    ->colors([
                        'success' => 'Desa',
                        'info' => 'Kelurahan',
                    ])
                    ->label('Jenis')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kode_pos')
                ->sortable(),

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
            'index' => ManageDesaKelurahanResource::route('/'),            
        ];
    }
}
