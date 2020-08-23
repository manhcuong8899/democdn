<?php

namespace VNPCMS\Banks\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use VNPCMS\Banks\Banks;

class Systembanks
{
    public function compose(View $view)
    {

        $banks = Banks::where('customer_id',0)->get();
        $view->with('systembanks', $banks);
    }
}
