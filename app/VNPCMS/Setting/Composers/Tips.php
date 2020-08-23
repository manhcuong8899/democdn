<?php

namespace VNPCMS\Setting\Composers;

use App\Models\Support;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;


class Tips
{
    public function compose(View $view)
    {
        $tips = \App\Models\Tips::orderBy('order','asc')->get();
        $view->with('tips', $tips);
    }
}
