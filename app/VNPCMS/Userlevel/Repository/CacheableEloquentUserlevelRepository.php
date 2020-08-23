<?php
namespace VNPCMS\Userlevel\Repository;
use VNPCMS\Userlevel\Repository\UserlevelRepositoryInterface;
use VNPCMS\Userlevel\Userlevel;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentUserlevelRepository implements UserlevelRepositoryInterface
{
    private $UserlevelRepository;

    private $cache;

    public function __construct(UserlevelRepositoryInterface $UserlevelRepository, Cache $cache)
    {
        $this->UserlevelRepository = $UserlevelRepository;
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
        return $this->UserlevelRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */


    public function byId($id)
    {
        return $this->cache->tags('Userlevel')->rememberForever('Userlevel.byId.'.$id, function () use ($id) {
            return $this->UserlevelRepository->byId($id);
        });
    }

    public function FindByCateId($id)
    {
        return $this->cache->tags('Userlevel')->rememberForever('Userlevel.FindByCateId.'.$id, function () use ($id) {
            return $this->UserlevelRepository->FindByCateId($id);
        });
    }

    public function UserlevelNull($code,$cate_id)
    {
        return $this->cache->tags('Userlevel')->rememberForever('Userlevel.UserlevelNull.'.$code.$cate_id, function () use ($code,$cate_id) {
            return $this->UserlevelRepository->UserlevelNull($code,$cate_id);
        });
    }

    public function UserlevelNullUpdate($code,$cate_id,$id)
    {
        return $this->cache->tags('Userlevel')->rememberForever('Userlevel.UserlevelNull.'.$code.$cate_id.$id, function () use ($code,$cate_id,$id) {
            return $this->UserlevelRepository->UserlevelNullUpdate($code,$cate_id,$id);
        });
    }


    public function deleteById($id)
    {
        return $this->UserlevelRepository->deleteById($id);
    }



    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Userlevel $Userlevel, array $attributes)
    {
        return $this->UserlevelRepository->update($Userlevel,$attributes);
    }
}
