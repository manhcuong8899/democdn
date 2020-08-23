<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Join_property;
use App\Models\Linktype;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use VNPCMS\Article\Articles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use VNPCMS\Catearticle\CateArticles;


class ArticlesController extends Controller
{
    public function list_articles($group)
    {
        $groupname = Linktype::where('vn',$group)->first();
        $articles = Articles::orderBy('order','asc')
            ->where('group',$groupname->en)->paginate(10);
        $new = Articles::orderBy('id','desc')
            ->where('group',$groupname->en)->paginate(10);
        $header = getHeader($groupname->name,'','');
        return view('themes.home.listarticles',compact('articles','groupname','new','header'));
    }

    public function detail($group,$slug)
    {
        $groupname = Linktype::where('vn',$group)->first();
        $detail = Articles::where('slug',$slug)->first();
        $new = Articles::orderBy('id','desc')
            ->where('group',$groupname->en)->paginate(10);
        $header = getHeader($detail->name, $detail->keywords, $detail->description);
        return view('themes.home.detail',compact('detail','groupname','new','header'));
    }

}