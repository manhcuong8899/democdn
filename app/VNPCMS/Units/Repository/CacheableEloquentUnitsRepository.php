<?php
namespace VNPCMS\Units\Repository;
use VNPCMS\Units\Repository\UnitsRepositoryInterface;
use VNPCMS\Units\Units;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentUnitsRepository implements UnitsRepositoryInterface
{
    private $UnitsRepository;

    private $cache;

    public function __construct(UnitsRepositoryInterface $UnitsRepository, Cache $cache)
    {
        $this->UnitsRepository = $UnitsRepository;
        $this->cache = $cache;
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
        return $this->UnitsRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */


    public function byId($id)
    {
        return $this->cache->tags('Units')->rememberForever('Units.byId.'.$id, function () use ($id) {
            return $this->UnitsRepository->byId($id);
        });
    }

    public function GetAll()
    {
        return $this->cache->tags('Units')->rememberForever('Units.all', function (){
            return $this->UnitsRepository->GetAll();
        });
    }

    public function UnitsNull($name)
    {
        return $this->cache->tags('Units')->rememberForever('Units.UnitsNull', function () use ($name) {
            return $this->UnitsRepository->UnitsNull($name);
        });
    }

    public function UnitsNullUpdate($name,$id)
    {
        return $this->cache->tags('Units')->rememberForever('Units.UnitsNull.'.$name.$id, function () use ($name,$id) {
            return $this->UnitsRepository->UnitsNullUpdate($name,$id);
        });
    }


    public function deleteById($id)
    {
        return $this->UnitsRepository->deleteById($id);
    }



    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Units $Units, array $attributes)
    {
        return $this->UnitsRepository->update($Units,$attributes);
    }
}
