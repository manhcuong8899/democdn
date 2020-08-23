<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Groupproducts;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use VNPCMS\Article\Articles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use App\Models\Emails;
use Cart;
use ProxyCrawlAPI;



class HomeController extends Controller
{

    public function index()
    {
        $title = $this->configCode('titlehomepage');
        $keywords = $this->configCode('keywords');
        $description = $this->configCode('description');
        $header = getHeader($title, $keywords, $description);
        $group = Groupproducts::orderBy('order','asc')->where('block','trangchu')->where('status',1)->get();
        $pview = Cart::instance('watched')->content(20);
        $countpview = Cart::instance('watched')->count();

        return view('themes.home.index',compact('group','pview','countpview','header'));
    }


    public function emails(Request $request)
    {
        $all = $request->all();
        $null = Emails::where('email',$request->email)->get()->count();
        if($null!=0)
        {
            return redirect()->back()->withErrors('Email đăng ký nhận tin đã tồn tại!');
        }
        Emails::create($all);

        return redirect()->back()->with('status','Email bạn đã được chấp nhận thành công');
    }

    public function successorder()
    {
        return view('themes.products.success');
    }

    public function gioithieu()
    {
        $detail = Articles::where('group','introductions')->first();

        $title = $detail->name;
        $keywords = $this->configCode('keywords');
        $description = $this->configCode('description');
        $header = getHeader($title, $keywords, $description);

        return view('themes.home.gioithieu',compact('detail','header'));
    }


    public function lienhe()
    {
        $title = "Liên hệ";
        $keywords = $this->configCode('keywords');
        $description = $this->configCode('description');
        $header = getHeader($title, $keywords, $description);
        return view('themes.home.lienhe',compact('header'));
    }


}