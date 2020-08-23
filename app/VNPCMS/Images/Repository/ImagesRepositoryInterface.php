<?php
namespace VNPCMS\Images\Repository;
use VNPCMS\Images\Images;

interface ImagesRepositoryInterface
{
    public function getByGroup($group);
    public function getAll();
    public function getSeach($categories);
    public function ById($id);


    public function create($attributes);
    public function deleteById($id);
    public function update(Images $images, array $attributes);
}
