<?php

namespace VNPCMS\Menu\Repository;

use VNPCMS\Menu\Menu;

interface MenuRepositoryInterface
{
    public function getAll();
    public function byId($id);
    public function byGroup($group);

    public function create(array $attributes);
    public function deleteById($menuId);
    public function update(Menu $menu, array $attributes);
}
