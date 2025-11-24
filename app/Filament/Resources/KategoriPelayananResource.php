<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriPelayananResource\Pages\ManageKategoriPelayanan;
use App\Models\KategoriLayanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KategoriPelayananResource extends Resource
{
    protected static ?string $model = KategoriLayanan::class;
    protected static ?string $navigationGroup = 'Manajemen E-Gov';
    protected static ?string $navigationLabel = 'Manajemen Layanan E-Gov';
    protected static ?string $pluralModelLabel = 'Manajemen Layanan E-Gov';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('category')
                    ->label('Kategori Layanan')
                    ->string()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->label('Nama Layanan')
                    ->string()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi_kategori')
                    ->label('Deskripsi')
                    ->columnSpanFull()
                    ->string()
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('sort')
                //     ->label('Urutan')
                //     ->default(PostCategory::query()->max('sort') + 1)
                //     ->required()
                //     ->numeric()
                //     ->default(0),
                Forms\Components\Toggle::make('active')
                    ->label('Aktif')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort')
            ->reorderable('sort')
            ->paginated(false)
            ->reorderable(false)
            ->searchable(false)
            ->columns([            
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori Layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi_kategori')
                    ->label('Deskripsi Kategori')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\ToggleColumn::make('active')
                    ->label('Aktif'),
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
            'index' => ManageKategoriPelayanan::route('/'),
        ];
    }
}
