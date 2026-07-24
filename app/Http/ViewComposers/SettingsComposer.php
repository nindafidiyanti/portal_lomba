<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Setting;

class SettingsComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $view->with('settings', [
            'cabangOlahraga' => Setting::cabangOlahraga()->orderBy('name')->pluck('name')->toArray(),
            'kategoriPeserta' => Setting::kategoriPeserta()->orderBy('name')->pluck('name')->toArray(),
        ]);
    }
}
