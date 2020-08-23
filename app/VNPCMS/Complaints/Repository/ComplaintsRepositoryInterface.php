<?php
namespace VNPCMS\Complaints\Repository;
use VNPCMS\Complaints\Complaints;

interface ComplaintsRepositoryInterface
{
    public function ById($id);
    public function GetAll();
    public function GetByStatus($status);


    public function SeachByDate($articles);
    public function SeachByCode($articles);
    public function SeachAll($articles);

    public function deleteById($id);
}
