<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditCafeProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Profil Cafe';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->schema([
                        TextInput::make('name')
                            ->disabled() // Admin manages the name
                            ->required(),
                        TextInput::make('tagline')
                            ->maxLength(255),
                        Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('address')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Kontak & Media')
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->tel(),
                        TextInput::make('instagram_url')
                            ->url(),
                        TextInput::make('tiktok_url')
                            ->url(),
                        FileUpload::make('image_path')
                            ->label('Foto Utama')
                            ->image()
                            ->directory('cafes'),
                        FileUpload::make('menu_image_path')
                            ->label('Foto Menu Global')
                            ->image()
                            ->directory('cafes/menus'),
                    ])->columns(2),

                Section::make('Jam Operasional')
                    ->schema([
                        TimePicker::make('opening_time'),
                        TimePicker::make('closing_time'),
                    ])->columns(2),
            ]);
    }
}
