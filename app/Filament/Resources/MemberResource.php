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
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;  // Ubah import ini

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
                TextColumn::make('kta_new')
                    ->label('No. KTA')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('kta_old')
                    ->label('No. KTA Lama')
                    ->sortable()
                    ->searchable(),
                // TextColumn::make('couple_name')
                //     ->label('Nama Istri/Suami')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('last_education')
                //     ->label('Pendidikan Terakhir')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('recomend_name')
                //     ->label('Nama Rekomendasi')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('recomend_jabatan')
                //     ->label('Jabatan Rekomendasi')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('recomend_telp')
                //     ->label('Telepon Rekomendasi')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('social_media')
                //     ->label('Social Media')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('social_media_link')
                //     ->label('Link Social Media')
                //     ->sortable()
                //     ->searchable(),
                TextColumn::make('level_pengurusan')
                    ->label('Level Pengurusan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->sortable()
                    ->searchable(),
                // TextColumn::make('pekerjaan')
                //     ->label('Pekerjaan')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('provinsi')
                //     ->label('Provinsi')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('kotakab')
                //     ->label('Kota/Kabupaten')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('kecamatan')
                //     ->label('Kecamatan')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('desa')
                //     ->label('Desa')
                //     ->sortable()
                //     ->searchable(),
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
            ->filters([
                Tables\Filters\SelectFilter::make('pekerjaan')
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
                Tables\Filters\SelectFilter::make('level_pengurusan')
                    ->label('Level Pengurusan'),
                Tables\Filters\SelectFilter::make('provinsi')
                    ->label('Provinsi'),
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
                ExportAction::make()
                    ->label('Export Excel')
                    ->exports([
                        ExcelExport::make()
                            ->withFilename(fn($resource) => $resource::getLabel())
                            ->fromForm()
                    ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
