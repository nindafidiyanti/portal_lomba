<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Setting;

class CaborComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $view->with('cabors', Setting::cabangOlahraga()->orderBy('name')->pluck('name')->toArray());
    }
}
