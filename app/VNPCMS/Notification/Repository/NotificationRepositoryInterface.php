<?php
namespace VNPCMS\Notification\Repository;
use VNPCMS\Notification\Notification;

interface NotificationRepositoryInterface
{
    public function ById($id);
    public function GetAll($type);
    public function NotificationNull($name);
    public function NotificationNullupdate($name,$id);

    public function create($attributes);
    public function deleteById($id);
    public function update(Notification $article, array $attributes);
}
