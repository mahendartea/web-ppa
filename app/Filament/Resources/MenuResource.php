<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Menu;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Infolists\Components\IconEntry;
use App\Filament\Resources\MenuResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MenuResource\RelationManagers;
use Filament\Forms\Components\Select;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Menu';
    protected static ?string $navigationLabel = 'Menu';
    protected static bool $shouldRegisterNavigation = false;

    public static function getPluralLabel(): string
    {
        return 'Daftar Menu'; // Ganti dengan label jamak yang diinginkan
    }


    public static function form(Form $form): Form
    {
        return $form
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
                    }),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('link')
                    ->label('URL')
                    ->placeholder('https://example.com')
                    ->helperText('Masukkan link yang valid dimulai dengan http atau https.')
                    ->disabled()
                    ->url() // Validasi agar hanya menerima URL valid
                    ->maxLength(255),
                Select::make('urutan')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8',
                        '9' => '9',
                        '10' => '10',
                    ])->unique(),
                Forms\Components\TextInput::make('icon')
                    ->label('Heroicon')
                    ->placeholder('ex: heroicon-o-heart')
                    ->helperText('Gunakan heroicon dengan format heroicon-{style}-{name}.'),
                ColorPicker::make('color')
                    ->label('Color')
                    ->placeholder('#3498db'),
                TextInput::make('description')->label('Deskripsi'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('slug'),
                TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),
                TextColumn::make('link')
                    ->label('URL'),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->formatStateUsing(fn($state) => view('components.icon', ['icon' => $state])),
                ColorColumn::make('color')
                    ->label('Color')
                    ->copyable(true) // Menambahkan fitur salin warna
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description'),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
