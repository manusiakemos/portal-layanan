<?php

namespace App\Filament\Resources\KecamatanResource;

use App\Filament\Resources\KecamatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class ManageKecamatanResource extends ManageRecords
{
    protected static string $resource = KecamatanResource::class;

    protected static ?string $title = 'Manajemen Kecamatan';

    /**
     * Tombol header (di atas tabel)
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Kecamatan')
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
                ->modalHeading('Hapus Kecamatan')
                ->modalDescription('Apakah Anda yakin ingin menghapus data ini?'),
        ];
    }
}