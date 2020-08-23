<?php
namespace VNPCMS\Notification\Repository;
use VNPCMS\Notification\Repository\NotificationRepositoryInterface;
use VNPCMS\Notification\Notification;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentNotificationRepository implements NotificationRepositoryInterface
{
    private $NotificationRepository;

    private $cache;

    public function __construct(NotificationRepositoryInterface $NotificationRepository, Cache $cache)
    {
        $this->NotificationRepository = $NotificationRepository;
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
        return $this->NotificationRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */


    public function byId($id)
    {
        return $this->cache->tags('Notification')->rememberForever('Notification.byId.'.$id, function () use ($id) {
            return $this->NotificationRepository->byId($id);
        });
    }

    public function GetAll($type)
    {
        return $this->cache->tags('Notification')->rememberForever('Notification.all', function () use($type){
            return $this->NotificationRepository->GetAll($type);
        });
    }

    public function NotificationNull($name)
    {
        return $this->cache->tags('Notification')->rememberForever('Notification.NotificationNull', function () use ($name) {
            return $this->NotificationRepository->NotificationNull($name);
        });
    }

    public function NotificationNullUpdate($name,$id)
    {
        return $this->cache->tags('Notification')->rememberForever('Notification.NotificationNull.'.$name.$id, function () use ($name,$id) {
            return $this->NotificationRepository->NotificationNullUpdate($name,$id);
        });
    }


    public function deleteById($id)
    {
        return $this->NotificationRepository->deleteById($id);
    }



    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Notification $Notification, array $attributes)
    {
        return $this->NotificationRepository->update($Notification,$attributes);
    }
}
