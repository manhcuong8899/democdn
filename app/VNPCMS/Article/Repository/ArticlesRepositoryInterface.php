<?php
namespace VNPCMS\Article\Repository;
use VNPCMS\Article\Articles;

interface ArticlesRepositoryInterface
{
    public function getByGroup($group);
    public function getBySeach($group,$categories,$text);
    public function ById($id);
    public function ByName($name);
    public function ArticleNull($name);
    public function ArticleNullUpdate($name,$id);

    public function create($attributes);
    public function deleteById($id);
    public function update(Articles $article, array $attributes);
}
