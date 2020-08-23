<?php

namespace VNPCMS\Setting\Repository;

use VNPCMS\Setting\Setting;
use VNPCMS\Setting\Repository\SettingRepositoryInterface;
use Illuminate\Contracts\Cache\Repository as Cache;

/*
 * Decorator class of VNPCMS\Setting\Repository\EloquentSettingRepository
 */

class CacheableEloquentSettingRepository implements SettingRepositoryInterface
{
    private $settingRepository;

    private $cache;

    public function __construct(SettingRepositoryInterface $settingRepository, Cache $cache)
    {
        $this->settingRepository = $settingRepository;
        $this->cache = $cache;
    }

    /**
     * All settings cached.
     *
     * @return Collection
     */
    public function getAll()
    {
        return $this->cache->tags('settings')->rememberForever('setting.all', function () {
            return $this->settingRepository->getAll();
        });
    }

    /**
     * Get setting by key cached.
     *
     * @param $key
     */
    public function byKey($key)
    {
        return $this->cache->tags('settings')->rememberForever('setting.byKey.'.$key, function () use ($key) {
            return $this->settingRepository->byKey($key);
        });
    }

    /**
     * Create new setting.
     *
     * @param array attributes
     *
     * @return Setting
     */
    public function create(array $attributes)
    {
        return $this->settingRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */
    public function deleteByKey($key)
    {
        return $this->settingRepository->deleteByKey($key);
    }

    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Setting $setting, array $attributes)
    {
        return $this->settingRepository->update($setting, $attributes);
    }
}
