<?php
namespace VNPCMS\Property\Repository;
use VNPCMS\Property\Properties;

interface PropertiesRepositoryInterface
{
    public function getByGroup($group);
    public function getAll();
    public function ById($id);
    public function FindByCateId($id);
    public function PropertyNull($value,$cate);
    public function PropertyNullUpdate($value,$cate,$id);
    public function PropertyForCates($cates,$property);

    public function create($attributes);
    public function deleteById($id);
    public function deleteAllCate($property);
    public function update(Properties $article, array $attributes);
}
