<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kecamatan;
use App\Models\SmartDesa;
use Filament\Tables\Table;
use App\Models\DesaKelurahan;
use App\Models\KategoriLayanan;
use App\Models\SuratPermohonan;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\SmartDesaResource\Pages\ManageSmartDesaResource;

class SmartDesaResource extends Resource
{
    protected static ?string $model = SmartDesa::class;
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Layanan E-Government';
    protected static ?string $navigationLabel = 'Pendaftaran Smart Desa';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                /** ======================
                 *  SURAT PERMOHONAN
                 * ====================== */
                Select::make('surat_permohonan_id')
                    ->label('Nama Pemohon')
                    ->options(function () {

                        // Cari kategori Program Khusus → Pendaftaran SmartDesa
                        $kategoriId = KategoriLayanan::where('category', 'Program Khusus')
                            ->where('name', 'Pendaftaran SmartDesa')
                            ->value('id');

                        if (!$kategoriId) return [];

                        return SuratPermohonan::where('status', 'Disetujui')
                            ->where('kategori_layanan_id', $kategoriId)
                            ->pluck('nama_pemohon', 'id');
                    })
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $surat = SuratPermohonan::with('skpd')->find($state);

                        if ($surat) {
                            $set('jabatan', $surat->jabatan);
                            $set('skpd_nama', $surat->skpd->nama ?? '-');
                            $set('nomor_aktif', $surat->nomor_aktif);
                        }
                    })
                    ->required(),

                TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->disabled()
                    ->dehydrated(true)
                    ->helperText('Terisi otomatis dari Surat Permohonan'),

                TextInput::make('skpd_nama')
                    ->label('SKPD')
                    ->disabled()
                    ->dehydrated(true)
                    ->helperText('Terisi otomatis dari Surat Permohonan'),

                TextInput::make('nomor_aktif')
                    ->label('Nomor Telepon')
                    ->disabled()
                    ->dehydrated(true)
                    ->helperText('Terisi otomatis dari Surat Permohonan'),

                /** ======================
                 *  KECAMATAN
                 * ====================== */
                Select::make('kecamatan_id')
                    ->label('Kecamatan')
                    ->options(
                        Kecamatan::get()->mapWithKeys(function ($item) {
                            return [$item->id => "{$item->kode_kecamatan} - {$item->nama}"];
                        })
                    )
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('desa_kelurahan_id', null))
                    ->required(),

                /** ======================
                 *  DESA / KELURAHAN
                 * ====================== */
               Select::make('desa_kelurahan_id')
                    ->label('Desa / Kelurahan')
                    ->options(function (callable $get) {
                        $kecamatanId = $get('kecamatan_id');

                        if (!$kecamatanId) {
                            return [];
                        }

                        return DesaKelurahan::where('kecamatan_id', $kecamatanId)
                            ->get()
                            ->mapWithKeys(function ($item) {
                                return [
                                    $item->id => $item->kode_pos . ' - ' . $item->nama
                                ];
                            });
                    })
                    ->searchable()
                    ->required(),
                /** ======================
                 *  ALAMAT
                 * ====================== */
                Textarea::make('alamat')
                    ->label('Alamat Lokasi')
                    ->required()
                    ->columnSpanFull(),

                Select::make('status_desa')
                    ->label('Status')
                    ->options([
                        'Menunggu' => 'Menunggu',
                        'Disetujui' => 'Disetujui',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->default('Menunggu')
                    ->columnSpanFull()
                    ->visible(fn() => auth()->user()->hasRole('super-admin'))
                    ->disabled(fn() => !auth()->user()->hasRole('super-admin'))
                    ->dehydrated(fn() => true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->searchable()
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('suratPermohonan.nama_pemohon')->label('Nama Pemohon'),
                Tables\Columns\TextColumn::make('suratPermohonan.nomor_aktif')->label('Nomor Aktif'),
                Tables\Columns\TextColumn::make('kecamatan.nama')->label('Kecamatan'),
                Tables\Columns\TextColumn::make('desa.nama')->label('Desa'),
                Tables\Columns\TextColumn::make('alamat')->label('Alamat')->limit(30),
                Tables\Columns\TextColumn::make('status_desa')
                    ->label('Status')
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'Menunggu'  => 'warning',
                            'Disetujui' => 'success',
                            'Ditolak'   => 'danger',
                            default     => 'secondary',
                        };
                    })
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
            'index' => ManageSmartDesaResource::route('/'),
        ];
    }
}