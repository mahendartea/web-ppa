<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Gallery Information')
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Slider')
                                    ->required(),
                                Forms\Components\FileUpload::make('image')
                                    ->label('Gambar Slider')
                                    ->required()
                                    ->preserveFilenames()
                                    ->directory('slider_images')
                                    ->maxSize(1024), // 1MB max size
                            ]),
                    ]),
                Forms\Components\Section::make('Slider Details')
                    ->schema([
                        Forms\Components\Textarea::make('description')->label('Deskripsi Slider'),
                        Forms\Components\TextInput::make('order')->label('Urutan')
                            ->numeric(),
                        Forms\Components\Toggle::make('is_active')->label('Status Aktif')
                            ->default(true),
                        Forms\Components\DateTimePicker::make('start_date')->label('Tanggal Mulai'),
                        Forms\Components\DateTimePicker::make('end_date')->label('Tanggal Selesai'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul Slider'),
                Tables\Columns\ImageColumn::make('image')->label('Image')->label('Gambar Slider'),
                Tables\Columns\TextColumn::make('order')->label('Urutan'),
                Tables\Columns\ToggleColumn::make('is_active')->label('Status'),
                Tables\Columns\TextColumn::make('start_date')->label('Mulai'),
                Tables\Columns\TextColumn::make('end_date')->label('Selesai'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
