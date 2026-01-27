<?php

namespace App\Filament\Resources\FacilityResource\Pages;

use App\Filament\Resources\FacilityResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFacility extends CreateRecord
{
    protected static string $resource = FacilityResource::class;

    protected function afterCreate(): void
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            $cafe = $user->cafes()->first();
            if ($cafe) {
                $this->record->cafes()->attach($cafe->id);
            }
        }
    }
}
