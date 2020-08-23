<?php

namespace VNPCMS\Setting\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use VNPCMS\Images\Images;


class ViewImages
{
    public function compose(View $view)
    {

        $cates = CateArticles::where('group','images')->get();
        $viewimages = array();
        foreach($cates as $value)
        {
            $viewimages[$value->code]= Images::where('cate_id',$value->id)->where('status','1')->orderby('order','asc')->get();
        }
        $view->with('viewimages', $viewimages);
    }
}
