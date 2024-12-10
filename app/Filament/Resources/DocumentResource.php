<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use App\Models\Document;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\DocumentResource\Pages;


class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-c-newspaper';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $navigationLabel = 'Dukumen';
    public static function getPluralLabel(): string
    {
        return 'Daftar Dokumen'; // Ganti dengan label jamak yang diinginkan
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->label('Judul Dokumen')
                                    ->afterStateHydrated(function (TextInput $component, ?string $state) {
                                        if (!empty($state)) {
                                            $component->state(ucwords($state));
                                        }
                                    })
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, ?string $state) {
                                        if (!empty($state)) {
                                            $set('slug', Str::slug($state));
                                        }
                                    })
                                    ->columnSpan(1),
                                TextInput::make('slug')
                                    ->required()
                                    ->columnSpan(1),
                            ]),
                        Forms\Components\Grid::make(1)
                            ->schema([
                                FileUpload::make('file')
                                    ->label('Upload File')
                                    ->required()
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->maxSize(2048)
                                    ->directory('uploads')
                                    ->preserveFilenames()
                                    ->openable()
                                    ->downloadable()
                                    ->helperText('Unggah file dalam format PDF. Maksimal 2MB.'),
                                TextInput::make('caption')
                                    ->label('Keterangan')
                                    ->placeholder('Masukkan keterangan dokumen')
                                    ->helperText('Tambahkan keterangan untuk dokumen ini'),
                            ]),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Nama File')->searchable(),
                IconColumn::make('file')
                    ->label('File')
                    ->icon(fn($record) => match (pathinfo($record->file, PATHINFO_EXTENSION)) {
                        'jpg', 'jpeg', 'png' => 'heroicon-o-photo',
                        'pdf' => 'heroicon-o-paper-clip',
                        default => 'heroicon-o-document',
                    })
                    ->tooltip(fn($record) => pathinfo($record->file, PATHINFO_BASENAME))
                    ->url(
                        fn($record): string => Storage::url($record->file),
                        shouldOpenInNewTab: true
                    ),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getView(): string
    {
        return 'filament.resources.documents.view';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
            'view' => Pages\ViewDocument::route('/{record}'),
        ];
    }
}
