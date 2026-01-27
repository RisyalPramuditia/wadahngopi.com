<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CafeResource\Pages;
use App\Models\Cafe;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CafeResource extends Resource
{
    protected static ?string $model = Cafe::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationGroup = 'Manajemen Cafe';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Cafe')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Cafe')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                if ($state) {
                                    $emailPrefix = str($state)->slug('')->toString();
                                    $set('owner_email', $emailPrefix . '@wadahngopi.test');
                                    $set('owner_name', 'Owner ' . $state);
                                    $set('owner_password', 'password'); // Default password for ease of use
                                }
                            }),
                        Forms\Components\TextInput::make('tagline')
                            ->label('Tagline')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('address')
                            ->label('Alamat')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Akun Owner')
                    ->schema([
                        Forms\Components\TextInput::make('owner_name')
                            ->label('Nama Owner')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('owner_email')
                            ->label('Email Owner')
                            ->email()
                            ->required()
                            ->unique(User::class, 'email')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('owner_password')
                            ->label('Password Owner')
                            ->password()
                            ->required()
                            ->minLength(8)
                            ->maxLength(255)
                            ->revealable(),
                    ])
                    ->columns(3)
                    ->visible(fn ($livewire) => $livewire instanceof Pages\CreateCafe),

                Forms\Components\Section::make('Kontak & Social Media')
                    ->schema([
                        Forms\Components\TextInput::make('whatsapp_number')
                            ->label('WhatsApp')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tiktok_url')
                            ->label('TikTok URL')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('google_maps_url')
                            ->label('Google Maps URL')
                            ->url()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columns(3),

                Forms\Components\Section::make('Lokasi')
                    ->schema([
                        Forms\Components\TextInput::make('latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->step(0.000001),
                        Forms\Components\TextInput::make('longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->step(0.000001),
                    ])->columns(2),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Foto Utama')
                            ->image()
                            ->directory('cafes')
                            ->maxSize(2048),
                        Forms\Components\FileUpload::make('menu_image_path')
                            ->label('Foto Menu')
                            ->image()
                            ->directory('cafes/menus')
                            ->maxSize(2048),
                    ])->columns(2),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'banned' => 'Banned',
                            ])
                            ->default('draft')
                            ->required(),
                        Forms\Components\Toggle::make('has_wifi')
                            ->label('WiFi Tersedia')
                            ->default(false),
                        Forms\Components\TextInput::make('rating')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(5)
                            ->step(0.1)
                            ->default(0),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Cafe')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('owner.name')
                    ->label('Owner')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'secondary' => 'draft',
                        'success' => 'published',
                        'danger' => 'banned',
                    ]),
                Tables\Columns\IconColumn::make('has_wifi')
                    ->label('WiFi')
                    ->boolean(),
                Tables\Columns\TextColumn::make('rating')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state, 1)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'banned' => 'Banned',
                    ]),
                Tables\Filters\TernaryFilter::make('has_wifi')
                    ->label('WiFi'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();

                // Owner only sees their own cafes
                if ($user->role === 'owner') {
                    $query->where('owner_id', $user->id);
                }

                // Admin sees all cafes
                return $query;
            });
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
            'index' => Pages\ListCafes::route('/'),
            'create' => Pages\CreateCafe::route('/create'),
            'view' => Pages\ViewCafe::route('/{record}'),
            'edit' => Pages\EditCafe::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()->role === 'admin' && filament()->getPanel()->getId() === 'admin';
    }
}
