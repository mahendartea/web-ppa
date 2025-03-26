<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Member;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use App\Filament\Resources\MemberResource\Pages;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use App\Filament\Resources\MemberResource\Actions\DownloadMembersList;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Keanggotaan';
    protected static ?string $navigationLabel = 'Pendaftaran';
    public static function getPluralLabel(): string
    {
        return 'Daftar Pendaftar'; // Ganti dengan label jamak yang diinginkan
    }
    public static function canCreate(): bool
    {
        return false;
    }
    //

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dokumen')
                    ->schema([
                        Forms\Components\FileUpload::make('ktp')
                            ->label('KTP')
                            ->required()
                            ->image()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']),
                        Forms\Components\FileUpload::make('foto')
                            ->label('Photo')
                            ->required()
                            ->image()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']),
                        Forms\Components\Toggle::make('is_conf_ktp_addr_valid')
                            ->label('Apakah saat ini anda bertempat tinggal di daerah Kabupaten/Kota sesuai dengan KTP-el ?')
                            ->required(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Informasi KTA')
                    ->schema([
                        Forms\Components\TextInput::make('kta_old')
                            ->label('Nomor KTA Lama')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('kta_new')
                            ->label('Nomor KTA Baru')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informasi Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nickname')
                            ->label('Nama Panggilan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('couple_name')
                            ->label('Nama Istri/Suami')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_education')
                            ->label('Pendidikan Terakhir')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telp')
                            ->label('No HP')
                            ->numeric()
                            ->minLength(10)
                            ->maxLength(15),
                        Forms\Components\Select::make('pekerjaan')
                            ->label('Pekerjaan')
                            ->options([
                                'Pelajar Mahasiswa' => 'Pelajar Mahasiswa',
                                'Profesional' => 'Profesional',
                                'Pegawai Swasta' => 'Pegawai Swasta',
                                'Wirausaha' => 'Wirausaha',
                                'Buruh' => 'Buruh',
                                'Pensiunan' => 'Pensiunan',
                                'Ibu Rumah Tangga' => 'Ibu Rumah Tangga',
                                'Petani' => 'Petani',
                                'Nelayan' => 'Nelayan',
                                'Lainnya' => 'Lainnya'
                            ]),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Informasi Rekomendasi')
                    ->schema([
                        Forms\Components\TextInput::make('recomend_name')
                            ->label('Nama')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('recomend_jabatan')
                            ->label('Jabatan')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('recomend_telp')
                            ->label('Telepon')
                            ->numeric()
                            ->minLength(10)
                            ->maxLength(15),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Media Sosial')
                    ->schema([
                        Forms\Components\TextInput::make('social_media')
                            ->label('Platform')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('social_media_link')
                            ->label('Link')
                            ->maxLength(255)
                            ->url(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informasi Pengurusan')
                    ->schema([
                        Forms\Components\TextInput::make('level_pengurusan')
                            ->label('Level')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('jabatan')
                            ->label('Jabatan')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Alamat')
                    ->schema([
                        Forms\Components\TextInput::make('provinsi')
                            ->label('Provinsi')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('kotakab')
                            ->label('Kota/Kabupaten')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('kecamatan')
                            ->label('Kecamatan')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('desa')
                            ->label('Desa')
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nickname')
                    ->label('Nama Panggilan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('telp')
                    ->label('No HP')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('kta_new')
                    ->label('No. KTA')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('kta_old')
                    ->label('No. KTA Lama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('level_pengurusan')
                    ->label('Level Pengurusan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular()
                    ->width(100),
                ImageColumn::make('ktp')
                    ->label('KTP')
                    ->width(100),
                ToggleColumn::make('is_conf_ktp_addr_valid')
                    ->label('Konfirmasi KTP')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Date Filter
                Tables\Filters\Filter::make('created_at_filter')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Tanggal Pendaftaran Dari'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Tanggal Pendaftaran Sampai'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Tanggal Pendaftaran dari: ' . Carbon::parse($data['created_from'])->format('d-m-Y');
                        }

                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Tanggal Pendaftaran sampai: ' . Carbon::parse($data['created_until'])->format('d-m-Y');
                        }

                        return $indicators;
                    }),

                // Provinsi filter
                Tables\Filters\Filter::make('location_filters')
                    ->form([
                        Select::make('provinsi')
                            ->label('Provinsi')
                            ->options(function () {
                                return Member::distinct()
                                    ->whereNotNull('provinsi')
                                    ->pluck('provinsi', 'provinsi')
                                    ->toArray();
                            })
                            ->afterStateUpdated(function ($state, $set) {
                                $set('kotakab', null);
                                $set('kecamatan', null);
                                $set('desa', null);
                            })
                            ->live()
                            ->preload(),

                        Select::make('kotakab')
                            ->label('Kabupaten/Kota')
                            ->options(function ($get) {
                                $provinsi = $get('provinsi');

                                if (!$provinsi) {
                                    return [];
                                }

                                return Member::distinct()
                                    ->where('provinsi', $provinsi)
                                    ->whereNotNull('kotakab')
                                    ->pluck('kotakab', 'kotakab')
                                    ->toArray();
                            })
                            ->afterStateUpdated(function ($state, $set) {
                                $set('kecamatan', null);
                                $set('desa', null);
                            })
                            ->live()
                            ->preload(),

                        Select::make('kecamatan')
                            ->label('Kecamatan')
                            ->options(function ($get) {
                                $provinsi = $get('provinsi');
                                $kotakab = $get('kotakab');

                                if (!$provinsi || !$kotakab) {
                                    return [];
                                }

                                return Member::distinct()
                                    ->where('provinsi', $provinsi)
                                    ->where('kotakab', $kotakab)
                                    ->whereNotNull('kecamatan')
                                    ->pluck('kecamatan', 'kecamatan')
                                    ->toArray();
                            })
                            ->afterStateUpdated(function ($state, $set) {
                                $set('desa', null);
                            })
                            ->live()
                            ->preload(),

                        Select::make('desa')
                            ->label('Desa')
                            ->options(function ($get) {
                                $provinsi = $get('provinsi');
                                $kotakab = $get('kotakab');
                                $kecamatan = $get('kecamatan');

                                if (!$provinsi || !$kotakab || !$kecamatan) {
                                    return [];
                                }

                                return Member::distinct()
                                    ->where('provinsi', $provinsi)
                                    ->where('kotakab', $kotakab)
                                    ->where('kecamatan', $kecamatan)
                                    ->whereNotNull('desa')
                                    ->pluck('desa', 'desa')
                                    ->toArray();
                            })
                            ->preload(),
                    ])
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['provinsi'] ?? null) {
                            $indicators['provinsi'] = 'Provinsi: ' . $data['provinsi'];
                        }

                        if ($data['kotakab'] ?? null) {
                            $indicators['kotakab'] = 'Kabupaten/Kota: ' . $data['kotakab'];
                        }

                        if ($data['kecamatan'] ?? null) {
                            $indicators['kecamatan'] = 'Kecamatan: ' . $data['kecamatan'];
                        }

                        if ($data['desa'] ?? null) {
                            $indicators['desa'] = 'Desa: ' . $data['desa'];
                        }

                        return $indicators;
                    })
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['provinsi'] ?? null,
                                fn(Builder $query, $provinsi): Builder =>
                                $query->where('provinsi', $provinsi)
                            )
                            ->when(
                                $data['kotakab'] ?? null,
                                fn(Builder $query, $kotakab): Builder =>
                                $query->where('kotakab', $kotakab)
                            )
                            ->when(
                                $data['kecamatan'] ?? null,
                                fn(Builder $query, $kecamatan): Builder =>
                                $query->where('kecamatan', $kecamatan)
                            )
                            ->when(
                                $data['desa'] ?? null,
                                fn(Builder $query, $desa): Builder =>
                                $query->where('desa', $desa)
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    \App\Filament\Resources\MemberResource\Actions\DownloadPdf::make('download_pdf'),
                ])
            ])
            ->headerActions([
                DownloadMembersList::make(),
                ExportAction::make()
                    ->label('Export Excel')
                    ->exports([
                        ExcelExport::make()
                            ->withFilename(fn($resource) => $resource::getLabel() . '_' . date('Y-m-d'))
                            ->fromTable()
                            ->withColumns([
                                Column::make('name')
                                    ->heading('Nama'),
                                Column::make('nickname')
                                    ->heading('Nama Panggilan'),
                                Column::make('kta_new')
                                    ->heading('No. KTA Baru'),
                                Column::make('kta_old')
                                    ->heading('No. KTA Lama'),
                                Column::make('couple_name')
                                    ->heading('Nama Istri/Suami'),
                                Column::make('last_education')
                                    ->heading('Pendidikan Terakhir'),
                                Column::make('pekerjaan')
                                    ->heading('Pekerjaan'),
                                Column::make('telp')
                                    ->heading('No HP'),
                                Column::make('recomend_name')
                                    ->heading('Nama Rekomendasi'),
                                Column::make('recomend_jabatan')
                                    ->heading('Jabatan Rekomendasi'),
                                Column::make('recomend_telp')
                                    ->heading('Telepon Rekomendasi'),
                                Column::make('social_media')
                                    ->heading('Platform Media Sosial'),
                                Column::make('social_media_link')
                                    ->heading('Link Media Sosial'),
                                Column::make('level_pengurusan')
                                    ->heading('Level Pengurusan'),
                                Column::make('jabatan')
                                    ->heading('Jabatan'),
                                Column::make('telp')
                                    ->heading('No HP'),
                                Column::make('provinsi')
                                    ->heading('Provinsi'),
                                Column::make('kotakab')
                                    ->heading('Kabupaten/Kota'),
                                Column::make('kecamatan')
                                    ->heading('Kecamatan'),
                                Column::make('desa')
                                    ->heading('Desa'),
                                Column::make('is_conf_ktp_addr_valid')
                                    ->heading('Konfirmasi KTP')
                                    ->formatStateUsing(fn($state) => $state ? 'Ya' : 'Tidak'),
                                // Column::make('created_at')
                                //     ->heading('Tanggal Pendaftaran')
                                //     ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->format('d-m-Y') : ''),
                            ])
                            ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                    ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'view' => Pages\ViewMember::route('/{record}'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }

    public static function getActions(): array
    {
        return [
            ExportAction::make()->exports([
                ExcelExport::make('table')->withFilename(fn($resource) => $resource::getLabel()),
            ])
        ];
    }
}
