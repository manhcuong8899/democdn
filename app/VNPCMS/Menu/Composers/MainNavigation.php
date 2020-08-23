<?php

namespace VNPCMS\Menu\Composers;

use Illuminate\Contracts\View\View;
use VNPCMS\Menu\Repository\MenuRepositoryInterface;

class MainNavigation
{
    protected $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function compose(View $view)
    {
        $view->with('main', $this->menuRepository->byGroup('cms'));
    }
}
