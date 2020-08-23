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
use VNPCMS\Banks\BanksApplicationService;
use VNPCMS\Banks\Repository\BanksRepositoryInterface;

class BanksController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $banksRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BanksRepositoryInterface $banksRepository)
    {
        $this->banksRepository = $banksRepository;
        $this->middleware('auth');
    }

    /**

     *
     * @return View;
     **/
    public function index()
    {
        $cates = CateArticles::where('group','banks')->get();
        $banks = $this->banksRepository->getAll();
        return view('banks.index',compact('banks','cates'));
    }


    public function postcreate(Request $request)
    {
        $articles=$request->all();
        if(!isset($articles['categories']))
        {
            return redirect()->back()->withErrors('Bạn chưa chọn ngân hàng!');
        }

        if($articles['banknumber']=='' || $articles['accountbank']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tên hoặc số tài khoản!');
        }

        $articles['locale'] = getCurrentSessionAppLocale();

        $articles['cate_id'] = $request->categories;

        $customer = $request->customer_id;

        if(Auth::user()->hasRole('administrator')==false){
            $articles['customer_id'] = Auth::user()->id;
        }else{

            $articles['customer_id'] = 0;
            if($customer!=null){
                $articles['customer_id'] = $customer;
            }
        }

        $this->banksRepository->create($articles);

        return redirect()->back()->with('status','Bạn đã thêm tài khoản thành công');

    }

    public function edit(Request $request)
    {
        $bank = $this->banksRepository->ById($request->id);
        $category =  CateArticles::find($bank->cate_id);
        $cates =  CateArticles::where('group','banks')->where('id','!=',$bank->cate_id)->get();
        $banks = $this->banksRepository->getAll();
        return view('banks.edit',compact('bank','category','cates','banks'));
    }


    public function postupdate(Request $request)
    {
        $articles=$request->all();
        if(!isset($articles['categories']))
        {
            return redirect()->back()->withErrors('Bạn chưa chọn chủ đề!');
        }

        if($articles['banknumber']=='' || $articles['accountbank']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tên hoặc số tài khoản!');
        }

        $articles['locale'] = getCurrentSessionAppLocale();
        $articles['cate_id'] = $request->categories;

        $article = $this->banksRepository->ById($request->id);

        $this->banksRepository->update($article,$articles);

        return redirect()->back()->with('status','Đã sửa ngân hàng thành công!');
    }


    public function delete($id)
    {
        // see if authenticated user has permission to delete users

        $banksApplicationService = new BanksApplicationService();
        $banksApplicationService->delete($id);

        Flash::success('Xóa ngân hàng thành công!');

        return back();
    }

}