<?php

namespace App\Filament\Resources\DesaKelurahanResource;

use App\Filament\Resources\DesaKelurahanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class ManageDesaKelurahanResource extends ManageRecords
{
    protected static string $resource = DesaKelurahanResource::class;

    protected static ?string $title = 'Manajemen Desa dan Kelurahan';

    /**
     * Tombol header (di atas tabel)
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Desa / Kelurahan')
                ->icon('heroicon-o-plus-circle'),
        ];
    }

    /**
     * Override aksi tabel (edit dan delete)
     */
    protected function getTableActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit')
                ->icon('heroicon-o-pencil-square')
                ->color('warning'),

            DeleteAction::make()
                ->label('Hapus')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Hapus Desa / kelurahan')
                ->modalDescription('Apakah Anda yakin ingin menghapus data ini?'),
        ];
    }
}