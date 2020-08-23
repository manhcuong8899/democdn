<?php
namespace VNPCMS\Complaints\Repository;
use VNPCMS\Complaints\Repository\ComplaintsRepositoryInterface;
use VNPCMS\Complaints\Complaints;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentComplaintsRepository implements ComplaintsRepositoryInterface
{
    private $ComplaintsRepository;

    private $cache;

    public function __construct(ComplaintsRepositoryInterface $ComplaintsRepository, Cache $cache)
    {
        $this->ComplaintsRepository = $ComplaintsRepository;
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
        return $this->ComplaintsRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */


    public function byId($id)
    {
        return $this->cache->tags('Complaints')->rememberForever('Complaints.byId.'.$id, function () use ($id) {
            return $this->ComplaintsRepository->byId($id);
        });
    }

    public function GetAll()
    {
        return $this->cache->tags('Complaints')->rememberForever('Complaints.All', function (){
            return $this->ComplaintsRepository->GetAll();
        });
    }

    public function GetByStatus($status)
    {
        return $this->cache->tags('Complaints')->rememberForever('Complaints.Status', function () use ($status){
            return $this->ComplaintsRepository->GetByStatus($status);
        });
    }

    public function SeachByDate($articles)
    {
        return $this->cache->tags('Complaints')->rememberForever('Seachs.ByDate', function () use ($articles){
            return $this->ComplaintsRepository->SeachByDate($articles);
        });
    }


    public function SeachByCode($articles)
    {
        return $this->cache->tags('Complaints')->rememberForever('Seachs.ByCode', function () use ($articles){
            return $this->ComplaintsRepository->SeachByCode($articles);
        });
    }

    public function SeachAll($articles)
    {
        return $this->cache->tags('Complaints')->rememberForever('Seachs.All', function () use ($articles){
            return $this->ComplaintsRepository->SeachAll($articles);
        });
    }


    public function deleteById($id)
    {
        return $this->ComplaintsRepository->deleteById($id);
    }



    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Complaints $Complaints, array $attributes)
    {
        return $this->ComplaintsRepository->update($Complaints,$attributes);
    }
}
