<?php

namespace VNPCMS\Setting\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use VNPCMS\Notification\TypeNotification;


class Notificationuser
{
    public function compose(View $view)
    {
        $notificationuser = TypeNotification::where('group','users')->where('status',1)->get();
        $view->with('notificationuser', $notificationuser);
    }
}
