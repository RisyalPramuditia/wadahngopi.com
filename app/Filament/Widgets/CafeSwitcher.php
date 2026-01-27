<?php

namespace App\Filament\Widgets;

use App\Models\Cafe;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Session;

class CafeSwitcher extends Widget
{
    protected static string $view = 'filament.widgets.cafe-switcher';

    protected int|string|array $columnSpan = 'full';

    public function getCafes()
    {
        if (auth()->user()->role === 'admin') {
            return collect();
        }

        return auth()->user()->cafes;
    }

    public function getSelectedCafe()
    {
        $cafeId = Session::get('selected_cafe_id');

        if (! $cafeId && $this->getCafes()->count() === 1) {
            $cafeId = $this->getCafes()->first()->id;
            Session::put('selected_cafe_id', $cafeId);
        }

        return $cafeId ? Cafe::find($cafeId) : null;
    }

    public function selectCafe($cafeId)
    {
        Session::put('selected_cafe_id', $cafeId);

        $this->redirect(route('filament.admin.pages.dashboard'));
    }

    public static function canView(): bool
    {
        return auth()->user()->role === 'owner' && auth()->user()->cafes()->count() > 1;
    }
}
