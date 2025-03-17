<?php

namespace App\Filament\Resources\MemberResource\Actions;

use App\Models\Member;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class DownloadMembersList extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'download_members_list';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Download Daftar Anggota (PDF)')
            ->icon('heroicon-o-document-arrow-down')
            ->color('success')
            ->button()
            ->action(function () {
                // Get all members
                $members = Member::query()->get();

                // Generate PDF with pagination
                $perPage = 20;
                $totalMembers = $members->count();
                $totalPages = ceil($totalMembers / $perPage);

                // Create PDF
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.members-list', [
                    'members' => $members,
                    'page' => 1,
                    'totalPages' => $totalPages
                ])
                    ->setPaper('a4', 'landscape')
                    ->setOption('isRemoteEnabled', true)
                    ->setOption('isHtml5ParserEnabled', true);

                // Generate a clean filename with date
                $date = date('Y-m-d');
                $filename = "daftar-anggota-{$date}.pdf";

                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->output();
                }, $filename);
            });
    }
}
