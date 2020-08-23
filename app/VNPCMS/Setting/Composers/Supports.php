<?php

namespace VNPCMS\Setting\Composers;

use App\Models\Support;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use VNPCMS\Catearticle\CateArticles;


class Supports
{
    public function compose(View $view)
    {
        $supports = CateArticles::where('group','support')->get();
        $view->with('supports', $supports);
    }
}
