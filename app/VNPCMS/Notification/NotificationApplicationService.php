<?php

namespace VNPCMS\Notification;

use Illuminate\Support\Facades\App;
use VNPCMS\Notification\Notification;
use VNPCMS\Notification\Repository\NotificationRepositoryInterface;

class NotificationApplicationService
{

    /**
     * Create new Articles
     *
     * @return array
     *
     * @return Articles
     **/
    public function create($cate)
    {
        $cateRepository = App::make(NotificationRepositoryInterface::class);
        $cates = $cateRepository->create($cate);

        return $cates;
    }

    /**
     * Delete Articles by ID
     *
     * @param key
     *
     * @return void
     **/
    public function delete($id)
    {
        $catesRepository = App::make(NotificationRepositoryInterface::class);
        $catesRepository->deleteByid($id);
    }


    /**
     * Update Articles
     *
     * @param Articles
     * @param array attributes
     *
     * @return void
     **/
    public function update(Notification $id, array $attributes)
    {
        $catesRepository = App::make(NotificationRepositoryInterface::class);
        $catesRepository->update($id, $attributes);
    }

}