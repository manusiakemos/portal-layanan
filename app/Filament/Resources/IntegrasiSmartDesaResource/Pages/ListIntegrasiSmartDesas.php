<?php

namespace App\Filament\Resources\IntegrasiSmartDesaResource\Pages;

use App\Filament\Resources\IntegrasiSmartDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIntegrasiSmartDesas extends ListRecords
{
    protected static string $resource = IntegrasiSmartDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
