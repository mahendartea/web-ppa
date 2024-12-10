<?php

namespace App\Filament\Resources\MemberResource\Actions;

use Filament\Tables\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;

class DownloadPdf extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Download PDF')
            ->icon('heroicon-s-document-arrow-down')
            ->action(function ($record) {
                $pdf = Pdf::loadView('pdf.member', ['member' => $record]);
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->output();
                }, "pendaftaran-{$record->name}.pdf");
            });
    }
}
