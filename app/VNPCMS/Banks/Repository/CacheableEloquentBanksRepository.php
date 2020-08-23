<?php
namespace VNPCMS\Banks\Repository;
use VNPCMS\Banks\Repository\BanksRepositoryInterface;
use VNPCMS\Banks\Banks;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentBanksRepository implements BanksRepositoryInterface
{
    private $BanksRepository;

    private $cache;

    public function __construct(BanksRepositoryInterface $BanksRepository, Cache $cache)
    {
        $this->BanksRepository = $BanksRepository;
        $this->cache = $cache;
    }

    /**
     * All settings cached.
     *
     * @return Collection
     */
    public function getByGroup($group)
    {
        return $this->cache->tags('image')->rememberForever('image.group', function () use ($group) {
            return $this->BanksRepository->getByGroup($group);
        });
    }


    public function getAll()
    {
        return $this->cache->tags('image')->rememberForever('image.all', function (){
            return $this->BanksRepository->getAll();
        });
    }
    /**
     * Get setting by key cached.
     *
     * @param $key
     */

    /**
     * Create new setting.
     *
     * @param array attributes
     *
     * @return Setting
     */
    public function create($attributes)
    {
        return $this->BanksRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */

    public function byId($id)
    {
        return $this->cache->tags('image')->rememberForever('image.byId.'.$id, function () use ($id) {
            return $this->BanksRepository->byId($id);
        });
    }



    public function deleteById($id)
    {
        return $this->BanksRepository->deleteById($id);
    }

    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Banks $article, array $attributes)
    {
        return $this->BanksRepository->update($article,$attributes);
    }
}
