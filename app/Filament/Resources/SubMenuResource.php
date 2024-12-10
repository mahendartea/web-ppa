<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\SubMenu;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use App\Filament\Resources\SubMenuResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SubMenuResource\RelationManagers;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;

class SubMenuResource extends Resource
{
    protected static ?string $model = SubMenu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Menu';
    protected static ?string $navigationLabel = 'Sub Menu';
    protected static bool $shouldRegisterNavigation = false;
    public static function getPluralLabel(): string
    {
        return 'Daftar Sub Menu'; // Ganti dengan label jamak yang diinginkan
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
                Forms\Components\Select::make('menu_id')
                    ->label('Pilih Menu')
                    ->relationship('menu', 'name') // Mengambil data dari relasi menu
                    ->required()
                    ->placeholder('Pilih Menu'), // Placeholder untuk input select
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
                        '7' => '6',
                        '8' => '8',
                        '9' => '9',
                        '10' => '10',
                    ])->unique(),
                Forms\Components\TextInput::make('icon')
                    ->label('Heroicon')
                    ->placeholder('ex: heroicon-o-heart')
                    ->helperText('Gunakan heroicon dengan format heroicon-{style}-{name}.'),
                ColorPicker::make('color')
                    ->label('Warna')
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
                TextColumn::make('menu.name'),
                TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),
                TextColumn::make('link')
                    ->label('URL'),
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
            'index' => Pages\ListSubMenus::route('/'),
            'create' => Pages\CreateSubMenu::route('/create'),
            'edit' => Pages\EditSubMenu::route('/{record}/edit'),
        ];
    }
}
