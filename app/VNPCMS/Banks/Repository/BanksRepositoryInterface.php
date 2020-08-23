<?php
namespace VNPCMS\Banks\Repository;
use VNPCMS\Banks\Banks;

interface BanksRepositoryInterface
{
    public function getByGroup($group);
    public function getAll();
    public function ById($id);


    public function create($attributes);
    public function deleteById($id);
    public function update(Banks $Banks, array $attributes);
}
