<?php
namespace VNPCMS\Orders\Repository;
use VNPCMS\Orders\Orders;

interface OrdersRepositoryInterface
{
    public function ById($id);
    public function GetByType($type);
    public function GetByStatus($status);


    public function SeachByDate($articles);
    public function SeachByCode($articles);
    public function SeachAll($articles);

    public function deleteById($id);
}
