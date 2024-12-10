<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Galery;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\GaleryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GaleryResource\RelationManagers;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class GaleryResource extends Resource
{
    protected static ?string $model = Galery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $navigationLabel = 'Galeri';
    public static function getPluralLabel(): string
    {
        return 'Daftar Galeri';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Galeri')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->label('Nama')
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
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('kategori')
                                    ->label('Kategori')
                                    ->options([
                                        'sosialisasi' => 'Sosialisasi',
                                        'kepartaian' => 'Kepartaian',
                                        'solidaritas' => 'Solidaritas',
                                    ])
                                    ->required()
                                    ->columnSpan(1),
                                TextInput::make('description')
                                    ->label('Deskripsi')
                                    ->columnSpan(1),
                            ]),
                        Forms\Components\Grid::make(1)
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Upload Images')
                                    ->required()
                                    ->multiple()
                                    ->image()
                                    ->imageEditor()
                                    ->reorderable()
                                    ->maxFiles(5)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->maxSize(2048)
                                    ->directory('uploads/images')
                                    ->preserveFilenames()
                                    ->downloadable()
                                    ->helperText('Unggah maksimal 5 gambar dalam format JPG atau PNG. Maksimal 2MB per gambar.'),
                                TextInput::make('caption')
                                    ->label('Keterangan')
                                    ->placeholder('Masukkan keterangan gambar')
                                    ->helperText('Tambahkan keterangan untuk gambar ini'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kategori')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'sosialisasi' => 'success',
                        'kepartaian' => 'danger',
                        'solidaritas' => 'warning',
                        default => 'gray',
                    }),
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular()
                    ->stacked()
                    ->overLap(5)
                    ->limit(3)
                    ->limitedRemainingText()
                    ->width(50)
                    ->height(50),
                TextColumn::make('caption')
                    ->label('Keterangan')
                    ->limit(50),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGaleries::route('/'),
            'create' => Pages\CreateGalery::route('/create'),
            'view' => Pages\ViewGalery::route('/{record}'),
            'edit' => Pages\EditGalery::route('/{record}/edit'),
        ];
    }
}
