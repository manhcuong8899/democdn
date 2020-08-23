<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use App\Models\Crawler;

class CrawlerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    public function index()
    {
        $crawler = Crawler::orderBy('id','asc')->get();
        return view('crawler.index',compact('crawler'));
    }


    public function postcreate(Request $request)
    {
        $crawl=$request->all();
        if($crawl['key']=='' || $crawl['token']=='' || $crawl['formatdata']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền đầy đủ thông tin Key - Token - Format!');
        }
        Crawler::create($crawl);
        return redirect()->back()->with('status','Đã thêm CRAWLER thành công');
    }

    public function edit(Request $request)
    {
        $acrawler = Crawler::find($request->id);
        $crawler = Crawler::orderBy('id','asc')->get();
        return view('crawler.edit',compact('acrawler','crawler'));
    }


    public function postupdate(Request $request)
    {
        $crawl=$request->all();
        $acrawler = Crawler::find($request->id);
        if($crawl['key']=='' || $crawl['token']=='' || $crawl['formatdata']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền đầy đủ thông tin Key - Token - Format!');
        }
        $acrawler->key = $request->key;
        $acrawler->scraper = $request->scraper;
        $acrawler->token = $request->token;
        $acrawler->formatdata = $request->formatdata;
        $acrawler->get_cookies = $request->get_cookies;
        $acrawler->cookies_session = $request->cookies_session;
        $acrawler->autoparse = $request->autoparse;
        $acrawler->save();
        return redirect()->back()->with('status','Cập nhật thông tin Crwaler thành công!');
    }

    public function delete(Request $request)
    {
        Crawler::find($request->id)->delete();
        return redirect('admin/crawler')->with('status','Xóa Crawler thành công!');
        return back();
    }

}