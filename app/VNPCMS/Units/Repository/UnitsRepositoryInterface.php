<?php
namespace VNPCMS\Units\Repository;
use VNPCMS\Units\Units;

interface UnitsRepositoryInterface
{
    public function ById($id);
    public function GetAll();
    public function UnitsNull($name);
    public function UnitsNullupdate($name,$id);

    public function create($attributes);
    public function deleteById($id);
    public function update(Units $article, array $attributes);
}
