<?php
namespace VNPCMS\Images\Repository;
use VNPCMS\Images\Repository\ImagesRepositoryInterface;
use VNPCMS\Images\Images;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentImagesRepository implements ImagesRepositoryInterface
{
    private $imagesRepository;

    private $cache;

    public function __construct(ImagesRepositoryInterface $imagesRepository, Cache $cache)
    {
        $this->imagesRepository = $imagesRepository;
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
            return $this->imagesRepository->getByGroup($group);
        });
    }


    public function getAll()
    {
        return $this->cache->tags('image')->rememberForever('image.all', function (){
            return $this->imagesRepository->getAll();
        });
    }

    public function getSeach($categories)
    {
        return $this->cache->tags('image')->rememberForever('image.seach', function () use ($categories){
            return $this->imagesRepository->getSeach($categories);
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
        return $this->imagesRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */

    public function byId($id)
    {
        return $this->cache->tags('image')->rememberForever('image.byId.'.$id, function () use ($id) {
            return $this->imagesRepository->byId($id);
        });
    }



    public function deleteById($id)
    {
        return $this->imagesRepository->deleteById($id);
    }

    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Images $article, array $attributes)
    {
        return $this->imagesRepository->update($article,$attributes);
    }
}
