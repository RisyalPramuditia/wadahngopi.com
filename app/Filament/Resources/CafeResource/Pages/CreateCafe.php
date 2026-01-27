<?php

namespace App\Filament\Resources\CafeResource\Pages;

use App\Filament\Resources\CafeResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateCafe extends CreateRecord
{
    protected static string $resource = CafeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Create owner account
        $owner = User::create([
            'name' => $data['owner_name'],
            'email' => $data['owner_email'],
            'password' => Hash::make($data['owner_password']),
            'role' => 'owner',
        ]);

        // Set owner_id for cafe
        $data['owner_id'] = $owner->id;

        // Remove owner fields from cafe data
        unset($data['owner_name'], $data['owner_email'], $data['owner_password']);

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Cafe berhasil dibuat dan akun owner telah dibuat!';
    }
}
