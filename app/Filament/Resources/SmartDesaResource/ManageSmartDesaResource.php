<?php

namespace App\Filament\Resources\SmartDesaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\SmartDesaResource;

class ManageSmartDesaResource extends ManageRecords
{
    protected static string $resource = SmartDesaResource::class;

    protected static ?string $title = 'Pendaftaran SmartDesa';
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}