<?php

namespace App\Filament\Resources\WeddingPackageResource\Pages;

use App\Filament\Resources\WeddingPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeddingPackage extends EditRecord
{
    protected static string $resource = WeddingPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
