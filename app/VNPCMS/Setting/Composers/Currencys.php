<?php

namespace VNPCMS\Setting\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use VNPCMS\Currency\Currency;


class Currencys
{
    public function compose(View $view)
    {
        $currencys = Currency::orderBy('code','asc')->get();
        $view->with('currencys', $currencys);
    }
}
