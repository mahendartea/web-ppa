<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\News;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NewsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NewsResource\RelationManagers;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?int $navigationSort = 1;
    public static function getPluralLabel(): string
    {
        return 'Daftar Berita'; // Ganti dengan label jamak yang diinginkan
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->label('Nama')
                                    ->columnSpan(1)
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
                                    }),
                                TextInput::make('slug')
                                    ->required()
                                    ->columnSpan(1),
                            ]),

                        RichEditor::make('content')
                            ->required()
                            ->label('Konten')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'orderedList',
                                'unorderedList',
                                'h2',
                                'h3',
                                'undo',
                                'redo',
                            ])
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Upload Images')
                                    ->required()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->maxSize(2048)
                                    ->directory('uploads/news/images')
                                    ->preserveFilenames()
                                    ->helperText('Unggah gambar dalam format JPG atau PNG. Maksimal 2MB per gambar.')
                                    ->columnSpan(1),
                                TextInput::make('caption')
                                    ->label('Keterangan Gambar')
                                    ->columnSpan(1),
                            ]),
                    ])
                    ->columns(12)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Nama')->searchable(),
                TextColumn::make('content')
                    ->label('Konten')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn($record) => $record->content),
                ImageColumn::make('image')->width(100)->height(100),
                TextColumn::make('caption')
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'view' => Pages\ViewNews::route('/{record}'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
