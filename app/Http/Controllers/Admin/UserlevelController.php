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
use VNPCMS\Userlevel\userlevelApplicationService;
use VNPCMS\Userlevel\Repository\UserlevelRepositoryInterface;


class UserlevelController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $userlevelRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(userlevelRepositoryInterface $userlevelRepository)
    {
        $this->userlevelRepository = $userlevelRepository;

        $this->middleware('auth');
      $this->middleware('permission:config_management');
    }

    /**

     *
     * @return View;
     **/
    public function index()
    {
        $cates = CateArticles::where('group','userlevel')->get();
        $userlevels = array();
        foreach($cates as $value)
        {
            $userlevels[$value->id] = $this->userlevelRepository->FindByCateId($value->id);
        }
        return view('userlevel.index',compact('cates','userlevels'));
    }

    public function create()
    {
        return view('userlevel.create',compact('cates'));
    }


    public function postcreate(Request $request)
    {
        $articles=$request->all();

        if($articles['value']=='' || $articles['code']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền mã hoặc giá trị cấu hình!');
        }
        $articles['code'] = khongdau($request->code);
        $null = $this->userlevelRepository->UserlevelNull($articles['code'],$request->categories);

        if($null == false)
        {
            return redirect()->back()->withErrors('Cấu hình đã tồn tại!');
        }

        $articles['cate_id'] = $request->categories;

        $this->userlevelRepository->create($articles);

        return redirect()->back()->with('status','Bạn đã thêm cấu hình thành công');

    }

    public function edit(Request $request)
    {
        $level = $this->userlevelRepository->ById($request->id);
        $cates = CateArticles::where('group','userlevel')->get();
        $addcates = CateArticles::where('group','userlevel')->where('id','!=',$level->cate_id)->get();
        $userlevels = array();
        foreach($cates as $value)
        {
            $userlevels[$value->id] = $this->userlevelRepository->FindByCateId($value->id);
        }
        return view('userlevel.edit',compact('level','cates','userlevels','addcates'));
    }


    public function postupdate(Request $request)
    {
        $articles=$request->all();

        if($articles['value']=='' || $articles['code']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền mã hoặc giá trị cấu hình!');
        }
        $articles['code'] = khongdau($request->code);
        $null = $this->userlevelRepository->UserlevelNullUpdate($articles['code'],$request->categories,$request->id);

        if($null == false)
        {
            return redirect()->back()->withErrors('Cấu hình đã tồn tại!');
        }

        $articles['cate_id'] = $request->categories;

        $level = $this->userlevelRepository->ById($request->id);

        $this->userlevelRepository->update($level,$articles);

        return redirect()->back()->with('status','Đã sửa cấu hình thành công!');
    }


    public function delete($id)
    {
        // see if authenticated user has permission to delete users

        $userlevelApplicationService = new userlevelApplicationService();
        $userlevelApplicationService->delete($id);

        Flash::success('Xóa cấu hình thành công!');

        return back();
    }


    public function postcreatecates(Request $request)
    {
        if(!isset($request->categories))
        {
            return redirect()->back()->withErrors('Bạn chưa chọn danh mục sản phẩm!');
        }

            $this->userlevelRepository->deleteAllCate($request->Userlevel);

        $this->userlevelRepository->UserlevelForCates($request->categories,$request->Userlevel);

        return redirect()->back()->with('status','Bạn đã cập nhật thuộc tính cho danh mục sản phẩm thành công!');

    }

}