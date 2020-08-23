<?php
namespace VNPCMS\Orders\Repository;
use VNPCMS\Orders\Repository\OrdersRepositoryInterface;
use VNPCMS\Orders\Orders;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentOrdersRepository implements OrdersRepositoryInterface
{
    private $OrdersRepository;

    private $cache;

    public function __construct(OrdersRepositoryInterface $OrdersRepository, Cache $cache)
    {
        $this->OrdersRepository = $OrdersRepository;
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
        return $this->OrdersRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */


    public function byId($id)
    {
        return $this->cache->tags('Orders')->rememberForever('Orders.byId.'.$id, function () use ($id) {
            return $this->OrdersRepository->byId($id);
        });
    }

    public function GetByType($type)
    {
        return $this->cache->tags('Orders')->rememberForever('Orders.Type', function () use ($type){
            return $this->OrdersRepository->GetByType($type);
        });
    }

    public function GetByStatus($status)
    {
        return $this->cache->tags('Orders')->rememberForever('Orders.Status', function () use ($status){
            return $this->OrdersRepository->GetByStatus($status);
        });
    }

    public function SeachByDate($articles)
    {
        return $this->cache->tags('Orders')->rememberForever('Seachs.ByDate', function () use ($articles){
            return $this->OrdersRepository->SeachByDate($articles);
        });
    }


    public function SeachByCode($articles)
    {
        return $this->cache->tags('Orders')->rememberForever('Seachs.ByCode', function () use ($articles){
            return $this->OrdersRepository->SeachByCode($articles);
        });
    }

    public function SeachAll($articles)
    {
        return $this->cache->tags('Orders')->rememberForever('Seachs.All', function () use ($articles){
            return $this->OrdersRepository->SeachAll($articles);
        });
    }


    public function deleteById($id)
    {
        return $this->OrdersRepository->deleteById($id);
    }



    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Orders $Orders, array $attributes)
    {
        return $this->OrdersRepository->update($Orders,$attributes);
    }
}
