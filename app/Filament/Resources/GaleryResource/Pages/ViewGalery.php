<?php

namespace App\Filament\Resources\GaleryResource\Pages;

use App\Filament\Resources\GaleryResource;
use App\Models\Galery;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Infolist;

class ViewGalery extends ViewRecord
{
    protected static string $resource = GaleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Galeri')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nama')
                                    ->weight('bold'),
                                TextEntry::make('kategori')
                                    ->badge()
                                    ->color(fn(string $state): string => match ($state) {
                                        'sosialisasi' => 'success',
                                        'kepartaian' => 'danger',
                                        'solidaritas' => 'warning',
                                        default => 'gray',
                                    }),
                                TextEntry::make('description')
                                    ->label('Deskripsi')
                                    ->columnSpanFull(),
                            ]),

                        Grid::make(1)
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Gambar')
                                    ->columnSpanFull()
                                    ->extraImgAttributes(['class' => 'object-cover w-full h-full']),
                                TextEntry::make('caption')
                                    ->label('Keterangan')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
