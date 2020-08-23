<?php

namespace VNPCMS\Menu\Composers;

use Illuminate\Contracts\View\View;
use VNPCMS\Menu\Repository\MenuRepositoryInterface;

class SettingsNavigation
{
    protected $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function compose(View $view)
    {
        $view->with('settings', $this->menuRepository->byGroup('settings'));
    }
}
