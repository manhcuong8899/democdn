<?php

namespace VNPCMS\Setting\Composers;

use Illuminate\Contracts\View\View;
use VNPCMS\Setting\Repository\SettingRepositoryInterface;

class Settings
{
    protected $settingsRepository;

    public function __construct(SettingRepositoryInterface $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function compose(View $view)
    {
        $view->with('settings', $this->settingsRepository->getAll()->lists('value', 'key')->toArray());
    }
}
