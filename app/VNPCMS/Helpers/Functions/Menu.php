<?php

if (!function_exists('setMenuActiveExtract')) {

    /**
     * Returns active class or other
     *
     * @return string
     */
    function setMenuActiveExtract($path, $active = 'active')
    {
		if (Request::fullUrl() == url($path)){
            return $active;
        }

        return '';
    }
}
if (!function_exists('setMenuActive')) {

    /**
     * Returns active class or other
     *
     * @return string
     */
    function setMenuActive($path, $active = 'active')
    {
    //dump(Request::fullUrl());
        if (Request::is($path . '/*') || Request::is($path)) {
            return $active;
        }
        return '';
    }
}

if (!function_exists('getParentMenuSlugOptions')) {

    /**
     * Return slugs of Parent menus (not their children)
     *
     * @return array
     */
    function getParentMenus()
    {
        $slugs = App::make('VNPCMS\Menu\Repository\MenuRepositoryInterface');
        return $slugs->getParents();
    }
}

function menu_add($data, $parent = 0, $select = 0)
{
    foreach ($data as $val) {
        $id = $val['id'];
        $name = $val['name'];
        if ($val['parent_id'] == $parent) {
            if (old('parentid') == $id) {
                echo "<option value='$id' selected='selected'>$name</option>";
            } else if ($select!= 0 && $id == $select) {
                echo "<option value='$id' selected='selected'>$name</option>";
            } else {
                echo "<option value='$id'>$name</option>";
            }
            cate_parent($data, $id, $select);
        }
    }
}