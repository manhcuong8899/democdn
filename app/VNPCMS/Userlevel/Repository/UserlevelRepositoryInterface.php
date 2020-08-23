<?php
namespace VNPCMS\Userlevel\Repository;
use VNPCMS\Userlevel\Userlevel;

interface UserlevelRepositoryInterface
{
    public function ById($id);
    public function FindByCateId($id);
    public function UserlevelNull($code,$cate_id);
    public function UserlevelNullUpdate($code,$cate_id,$id);

    public function create($attributes);
    public function deleteById($id);
    public function update(Userlevel $article, array $attributes);
}
