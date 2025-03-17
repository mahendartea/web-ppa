<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use App\Filament\Resources\MemberResource\Actions\DownloadPdf;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Actions;

class ViewMember extends ViewRecord
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('download_pdf')
                ->label('Download PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    $record = $this->getRecord();
                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.member', ['member' => $record])
                        ->setPaper('a4')
                        ->setOption('isRemoteEnabled', true)
                        ->setOption('isHtml5ParserEnabled', true);

                    // Generate a clean filename
                    $cleanName = preg_replace('/[^A-Za-z0-9\\-]/', '-', $record->name);
                    $filename = "pendaftaran-{$cleanName}.pdf";

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, $filename);
                }),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make('Dokumen')
                    ->schema([
                        \Filament\Infolists\Components\ImageEntry::make('ktp')
                            ->label('KTP')
                            ->width(400),
                        \Filament\Infolists\Components\ImageEntry::make('foto')
                            ->label('Foto')
                            ->circular()
                            ->width(200),
                        \Filament\Infolists\Components\TextEntry::make('is_conf_ktp_addr_valid')
                            ->label('Konfirmasi Alamat KTP')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                '1' => 'success',
                                '0' => 'danger',
                            })
                            ->formatStateUsing(fn(string $state): string => match ($state) {
                                '1' => 'Valid',
                                '0' => 'Tidak Valid',
                            }),
                    ])
                    ->columns(3),

                \Filament\Infolists\Components\Section::make('Informasi KTA')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('kta_old')
                            ->label('Nomor KTA Lama'),
                        \Filament\Infolists\Components\TextEntry::make('kta_new')
                            ->label('Nomor KTA Baru'),
                    ])
                    ->columns(2),

                \Filament\Infolists\Components\Section::make('Informasi Pribadi')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('couple_name')
                            ->label('Nama Istri/Suami'),
                        \Filament\Infolists\Components\TextEntry::make('last_education')
                            ->label('Pendidikan Terakhir'),
                        \Filament\Infolists\Components\TextEntry::make('pekerjaan')
                            ->label('Pekerjaan'),
                    ])
                    ->columns(3),

                \Filament\Infolists\Components\Section::make('Informasi Rekomendasi')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('recomend_name')
                            ->label('Nama'),
                        \Filament\Infolists\Components\TextEntry::make('recomend_jabatan')
                            ->label('Jabatan'),
                        \Filament\Infolists\Components\TextEntry::make('recomend_telp')
                            ->label('Telepon'),
                    ])
                    ->columns(3),

                \Filament\Infolists\Components\Section::make('Media Sosial')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('social_media')
                            ->label('Platform'),
                        \Filament\Infolists\Components\TextEntry::make('social_media_link')
                            ->label('Link')
                            ->url(fn($record) => $record->social_media_link)
                            ->openUrlInNewTab(),
                    ])
                    ->columns(2),

                \Filament\Infolists\Components\Section::make('Informasi Pengurusan')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('level_pengurusan')
                            ->label('Level'),
                        \Filament\Infolists\Components\TextEntry::make('jabatan')
                            ->label('Jabatan'),
                    ])
                    ->columns(2),

                \Filament\Infolists\Components\Section::make('Alamat')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('provinsi')
                            ->label('Provinsi'),
                        \Filament\Infolists\Components\TextEntry::make('kotakab')
                            ->label('Kota/Kabupaten'),
                        \Filament\Infolists\Components\TextEntry::make('kecamatan')
                            ->label('Kecamatan'),
                        \Filament\Infolists\Components\TextEntry::make('desa')
                            ->label('Desa'),
                    ])
                    ->columns(2),
            ]);
    }
}
