<?php
namespace VNPCMS\Products\Repository;
use VNPCMS\Products\Products;

interface ProductsRepositoryInterface
{
    public function getAll();
    public function ById($id);
    public function ProductNull($model,$color);
    public function ProductNullUpdate($name,$code,$id);

    public function create($attributes);
    public function deleteById($id);
    public function deleteByall($slug_name);
    public function update(Products $article, array $attributes);

    /* ----- Font End */
    public function ByCate($id);
    public function ByGroup($id,$cate);
    public function ByAlso($cateid);
    public function GetDetail($slug);

}
