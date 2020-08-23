<?php

namespace VNPCMS\Menu\Composers;

use Illuminate\Contracts\View\View;
use VNPCMS\Menu\Repository\MenuRepositoryInterface;
use App\Models\SupperMenus;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use Illuminate\Support\Facades\App;
use VNPCMS\Catearticle\CateArticles;

class PublicNavigation
{
    protected $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function compose(View $view)
    {
        $lang = getCurrentSessionAppLocale();
        $cates = CateArticles::orderBy('order','asc')
            ->where('group','menus')
            ->where('parent_id',0)
            ->get();
        $menus = array();
        foreach($cates as $value)
         {
             $menus[$value->code]= SupperMenus::orderBy('order','asc')->where('cate_id',$value->id)->where('parent_id','0')->where('locale',$lang)->get();
         }

        $view->with('menus', $menus);
    }
}
