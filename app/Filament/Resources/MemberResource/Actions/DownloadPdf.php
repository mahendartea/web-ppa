<?php

namespace App\Filament\Resources\MemberResource\Actions;

use Filament\Tables\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DownloadPdf extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Download PDF')
            ->icon('heroicon-s-document-arrow-down')
            ->action(function ($record) {
                // Configure PDF options for better image handling
                $pdf = Pdf::loadView('pdf.member', ['member' => $record])
                    ->setPaper('a4')
                    ->setOption('isRemoteEnabled', true)
                    ->setOption('isHtml5ParserEnabled', true);

                // Generate a clean filename
                $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '-', $record->name);
                $filename = "pendaftaran-{$cleanName}.pdf";

                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->output();
                }, $filename);
            });
    }
}
