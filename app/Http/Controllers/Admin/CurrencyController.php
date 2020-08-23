<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use VNPCMS\Currency\CurrencyApplicationService;
use VNPCMS\Currency\Repository\CurrencyRepositoryInterface;


class CurrencyController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $currencyRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;

        $this->middleware('auth');
       $this->middleware('permission:config_management');
    }

    /**

     *
     * @return View;
     **/
    public function index()
    {
        $currency = $this->currencyRepository->GetAll();

        return view('currency.index',compact('currency'));
    }

    public function postcreate(Request $request)
    {
        $articles=$request->all();

        if($articles['name']=='' || $articles['code']=='' || $articles['value']=='')
        {
            return redirect()->back()->withErrors('Thiếu thông tin tỷ giá!');
        }

        $null = $this->currencyRepository->currencyNull($articles['code']);

        if($null == false)
        {
            return redirect()->back()->withErrors('Thông tin tỷ giá đã tồn tại!');
        }

        $this->currencyRepository->create($articles);

        return redirect()->back()->with('status','Bạn đã thêm tỷ giá thành công');

    }

    public function edit(Request $request)
    {
        $tygia = $this->currencyRepository->ById($request->id);
        $currency = $this->currencyRepository->GetAll();
        return view('currency.edit',compact('tygia','currency'));
    }


    public function postupdate(Request $request)
    {
        $articles=$request->all();

        if($articles['name']=='' || $articles['code']=='' || $articles['value']=='')
        {
            return redirect()->back()->withErrors('Thiếu thông tin tỷ giá!');
        }

        $null = $this->currencyRepository->currencyNullUpdate($articles['code'],$request->id);

        if($null == false)
        {
            return redirect()->back()->withErrors('Thông tin tỷ giá đã tồn tại!');
        }
        $unit = $this->currencyRepository->ById($request->id);

        $this->currencyRepository->update($unit,$articles);

        return redirect()->back()->with('status','Đã sửa tỷ giá thành công!');
    }


    public function delete($id)
    {
        // see if authenticated user has permission to delete users

        $currencyApplicationService = new currencyApplicationService();
        $currencyApplicationService->delete($id);

        Flash::success('Xóa tỷ giá thành công!');

        return back();
    }

}