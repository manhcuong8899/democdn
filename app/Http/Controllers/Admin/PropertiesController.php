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
use VNPCMS\Property\PropertiesApplicationService;
use VNPCMS\Property\Repository\PropertiesRepositoryInterface;


class PropertiesController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $propertiesRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PropertiesRepositoryInterface $propertiesRepository)
    {
        $this->propertiesRepository = $propertiesRepository;

        $this->middleware('auth');
       $this->middleware('permission:config_management');
    }

    /**

     *
     * @return View;
     **/
    public function index()
    {
        $properties = $this->propertiesRepository->getAll();
        $cates = CateArticles::where('group','properties')->get();

        $cates_products = CateArticles::where('group','products')->get()->toArray();
        return view('properties.index',compact('properties','cates','cates_products'));
    }

    public function create()
    {
        return view('properties.create',compact('cates'));
    }


    public function postcreate(Request $request)
    {
        $articles=$request->all();
        if(!isset($articles['categories']))
        {
            return redirect()->back()->withErrors('Bạn chưa chọn chủ đề!');
        }

        if($articles['value']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền giá trị thuộc tính!');
        }

        $null = $this->propertiesRepository->PropertyNull($request->value,$request->categories);

        if($null == false)
        {
            return redirect()->back()->withErrors('Thuộc tính đã tồn tại!');
        }

        $articles['locale'] = getCurrentSessionAppLocale();

        $articles['cate_id'] = $request->categories;

        $this->propertiesRepository->create($articles);

        return redirect()->back()->with('status','Bạn đã thêm thuộc tính thành công');

    }

    public function edit(Request $request)
    {
        $property = $this->propertiesRepository->ById($request->id);
        $category =  CateArticles::find($property->cate_id);
        $cates =  CateArticles::where('group','properties')->where('id','!=',$property->cate_id)->get();
        $properties = $this->propertiesRepository->getAll();
        return view('properties.edit',compact('property','category','cates','properties'));
    }


    public function postupdate(Request $request)
    {
        $articles=$request->all();
        if(!isset($articles['categories']))
        {
            return redirect()->back()->withErrors('Bạn chưa chọn danh mục thuộc tính!');
        }

        if($articles['value']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tên hoặc liên kết!');
        }

        $null = $this->propertiesRepository->PropertyNullUpdate($request->value,$request->categories,$request->id);

        if($null == false)
        {
            return redirect()->back()->withErrors('Thuộc tính đã tồn tại!');
        }


        $articles['locale'] = getCurrentSessionAppLocale();
        $articles['cate_id'] = $request->categories;

        $property = $this->propertiesRepository->ById($request->id);

        $this->propertiesRepository->update($property,$articles);

        return redirect()->back()->with('status','Đã sửa thuộc tính thành công!');
    }


    public function delete($id)
    {
        // see if authenticated user has permission to delete users

        $propertiesApplicationService = new PropertiesApplicationService();
        $propertiesApplicationService->delete($id);

        Flash::success('Xóa hình ảnh thành công!');

        return back();
    }


    public function postcreatecates(Request $request)
    {

        if(!isset($request->categories))
        {
            return redirect()->back()->withErrors('Bạn chưa chọn danh mục sản phẩm cần gán thuộc tính!');
        }

        $json = json_encode($request->categories);

            $cate = CateArticles::find($request->property);
            $cate->properties_id = $json;
            $cate->save();

        $this->propertiesRepository->deleteAllCate($request->property);

        $this->propertiesRepository->PropertyForCates($request->categories,$request->property);

        return redirect()->back()->with('status','Bạn đã cập nhật thuộc tính cho danh mục sản phẩm thành công!');

    }

}