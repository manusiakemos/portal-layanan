<?php

namespace App\Filament\Resources\IntegrasiSmartDesaResource\Pages;

use App\Filament\Resources\IntegrasiSmartDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIntegrasiSmartDesa extends EditRecord
{
    protected static string $resource = IntegrasiSmartDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
