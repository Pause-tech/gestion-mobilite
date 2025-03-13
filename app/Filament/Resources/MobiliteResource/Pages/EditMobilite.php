<?php

namespace App\Filament\Resources\MobiliteResource\Pages;

use App\Filament\Resources\MobiliteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMobilite extends EditRecord
{
    protected static string $resource = MobiliteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
