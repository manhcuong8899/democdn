<?php
namespace VNPCMS\Catearticle\Repository;
use VNPCMS\Catearticle\CateArticles;

interface CateArticlesRepositoryInterface
{
    public function getByGroup($group,$parent_id);
    public function getData($group);
    public function ById($id);
    public function getstatus_name($status);
    public function getparent_name($parent_id);
    public function FindSubCate($parent_id);



    public function create($attributes);
    public function deleteById($id);
    public function deleteAllId($cates);
    public function update(CateArticles $article, array $attributes);
}
