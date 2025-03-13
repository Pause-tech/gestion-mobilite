<?php

namespace App\Filament\Resources\MobiliteResource\Pages;

use App\Filament\Resources\MobiliteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMobilites extends ListRecords
{
    protected static string $resource = MobiliteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
