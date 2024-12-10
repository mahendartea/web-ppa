<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisiMisiResource\Pages;
use App\Filament\Resources\VisiMisiResource\Pages\CreateVisiMisi;
use App\Filament\Resources\VisiMisiResource\Pages\EditVisiMisi;
use App\Filament\Resources\VisiMisiResource\Pages\ListVisiMisis;
use App\Filament\Resources\VisiMisiResource\RelationManagers;
use App\Models\VisiMisi;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpOffice\PhpSpreadsheet\RichText\RichText;

class VisiMisiResource extends Resource
{
    protected static ?string $model = VisiMisi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Visi dan Misi')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                RichEditor::make('visi')
                                    ->label('Visi')
                                    ->required()
                                    ->columnSpan(1),
                                RichEditor::make('misi')
                                    ->label('Misi')
                                    ->required()
                                    ->columnSpan(1),
                            ]),
                        Grid::make(2)
                            ->schema([
                                RichEditor::make('tujuan')
                                    ->label('Tujuan')
                                    ->required()
                                    ->columnSpan(1),
                                RichEditor::make('slogan')->label('Slogan')->columnSpan(1),
                            ]),
                        Grid::make(1)
                            ->schema([
                                FileUpload::make('logo')->label('Logo')
                                    ->required()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->maxSize(2048)
                                    ->directory('uploads/images')
                                    ->preserveFilenames()
                                    ->helperText('Unggah gambar dalam format JPG atau PNG. Maksimal 2MB per gambar.')
                                    ->columnSpan(1),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('visi')->label('Visi'),
                TextColumn::make('misi')->label('Misi'),
                TextColumn::make('tujuan')->label('Tujuan'),
                TextColumn::make('slogan')->label('Slogan'),
                ImageColumn::make('logo')->label('Logo'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListVisiMisis::route('/'),
            'create' => Pages\CreateVisiMisi::route('/create'),
            'edit' => Pages\EditVisiMisi::route('/{record}/edit'),
        ];
    }
}
