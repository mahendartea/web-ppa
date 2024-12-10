<?php

namespace App\Filament\Resources\GaleryResource\Pages;

use App\Filament\Resources\GaleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGalery extends CreateRecord
{
    protected static string $resource = GaleryResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
