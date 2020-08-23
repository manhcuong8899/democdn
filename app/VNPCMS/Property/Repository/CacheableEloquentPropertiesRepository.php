<?php
namespace VNPCMS\Property\Repository;
use VNPCMS\Property\Repository\PropertiesRepositoryInterface;
use VNPCMS\Property\Properties;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentPropertiesRepository implements PropertiesRepositoryInterface
{
    private $PropertiesRepository;

    private $cache;

    public function __construct(PropertiesRepositoryInterface $PropertiesRepository, Cache $cache)
    {
        $this->PropertiesRepository = $PropertiesRepository;
        $this->cache = $cache;
    }

    /**
     * All settings cached.
     *
     * @return Collection
     */
    public function getByGroup($group)
    {
        return $this->cache->tags('Properties')->rememberForever('Properties.group', function () use ($group) {
            return $this->PropertiesRepository->getByGroup($group);
        });
    }

    public function getAll()
    {
        return $this->cache->tags('Properties')->rememberForever('Properties.all', function () {
            return $this->PropertiesRepository->getAll();
        });
    }

    /**
     * Get setting by key cached.
     *
     * @param $key
     */

    public function PropertyForCates($cates,$property)
    {
        return $this->PropertiesRepository->PropertyForCates($cates,$property);
    }



    public function PropertyNull($value,$cate)
    {
        return $this->cache->tags('properties')->rememberForever('properties.PropertyNull.'.$value.$cate, function () use ($value,$cate) {
            return $this->PropertiesRepository->PropertyNull($value,$cate);
        });
    }

    public function PropertyNullUpdate($value,$cate,$id)
    {
        return $this->cache->tags('properties')->rememberForever('properties.PropertyNullUpdate.'.$value.$id.$cate, function () use ($value,$cate,$id) {
            return $this->PropertiesRepository->PropertyNullUpdate($value,$cate,$id);
        });
    }

    /**
     * Create new setting.
     *
     * @param array attributes
     *
     * @return Setting
     */
    public function create($attributes)
    {
        return $this->PropertiesRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */


    public function byId($id)
    {
        return $this->cache->tags('properties')->rememberForever('properties.byId.'.$id, function () use ($id) {
            return $this->PropertiesRepository->byId($id);
        });
    }

    public function FindByCateId($id)
    {
        return $this->cache->tags('properties')->rememberForever('properties.FindByCateId.'.$id, function () use ($id) {
            return $this->PropertiesRepository->FindByCateId($id);
        });
    }


    public function deleteById($id)
    {
        return $this->PropertiesRepository->deleteById($id);
    }

    public function deleteAllCate($property)
    {
        return $this->PropertiesRepository->deleteAllCate($property);
    }

    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Properties $Properties, array $attributes)
    {
        return $this->PropertiesRepository->update($Properties,$attributes);
    }
}
