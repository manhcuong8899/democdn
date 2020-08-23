<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Join;
use App\Models\Join_mode;
use App\Models\Join_property;
use Illuminate\Support\Facades\DB;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use VNPCMS\Products\Products;
use VNPCMS\Products\ProductsApplicationService;
use VNPCMS\Products\Repository\ProductsRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\Linktype;
use App\Models\SupperMenus;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $productsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductsRepositoryInterface $articlesRepository)
    {
        $this->productsRepository = $articlesRepository;

        $this->middleware('auth');
        $this->middleware('permission:product_management');
    }

    /**
     *
     * @return View;
     **/
    public function index()
    {
        $cates = App::make(CateArticlesRepositoryInterface::class);
        $cates = $cates->getData('products');
        $products = $this->productsRepository->getAll();
        return view('products.index',compact('products','cates'));
    }

    public function listdetail(Request $request)
    {
        $products = Products::where('slug_name',$request->slug_name)->paginate(25);
        return view('products.listdetail',compact('products'));
    }

    public function create()
    {
        $cates = App::make(CateArticlesRepositoryInterface::class);
        $cates = $cates->getData('products');
        return view('products.create',compact('cates'));
    }


    public function postcreate(Request $request)
    {
        $articles=$request->all();
        $articles['code']=$request->code;

        if($articles['name']=='' || $articles['code']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tên hoặc mã sản phẩm!');
        }


        $null = $this->productsRepository->ProductNull($request->name,$request->code);

        if($null == false)
        {
            return redirect()->back()->withErrors('Sản phẩm đã tồn tại!');
        }

        /* Gán Slug cho sản phẩm */
        $linktype = Linktype::where('code','products')->first();
        $slug = $linktype->vn.'/'.khongdau(Input::get('name')).'-'.Str::slug(Input::get('code')).'.html';
        $lang = getCurrentSessionAppLocale();
        if($lang!='vn')
        {
            $slug = $linktype->en.'/'.khongdau(Input::get('name')).'-'.Str::slug(Input::get('code')).'.html';
        }
        $articles['slug']=$slug;
        $articles['slug_name']=Str::slug($request->name);
       /* $articles['slug_brand']=Str::slug($request->brand);*/

        /* -------------------------   */

        if(!isset($articles['categories']))
        {
            return redirect()->back()->withErrors('Bạn chưa chọn danh mục sản phẩm!');
        }
        $articles['model']=khongdau($request->code);
        $articles['cate_id'] = $request->categories;
        $articles['shortcate'] = $request->shortcate;
        $articles['longcate'] = $request->longcate;
        $jsonmode = json_encode($request->mode);
        $articles['mode'] = $jsonmode;
        $articles['locale'] = getCurrentSessionAppLocale();
        $articles['images']=null;
        if ($request->hasFile('input-image')) {
            $files = $request->file('input-image');
            foreach($files as $key=>$file){
                $sp = $request->name;
                $name = 'img-'.str_slug($sp).$key.'.'.$file->getClientOriginalExtension();
                if($key==0){
                    $name = $request->code.'.'.$file->getClientOriginalExtension();
                    $daidien = $name;
                    $articles['images']=$daidien;
                }
                $path = 'products/'.$articles['code'].'/'.$name;
                FileUtils::save_images($path,$file, 375, null);
            }
        }
        $newproduct = $this->productsRepository->create($articles);
        return redirect()->back()->with('status','Bạn đã tạo sản phẩm thành công');

    }

    public function edit(Request $request)
    {
        $product = $this->productsRepository->ById($request->id);
        $path ='products/'.$product->code;
        $files_images = Storage::disk('images')->files($path);

        $category = App::make(CateArticlesRepositoryInterface::class);
        $category =   $category->getData('products');
        $modes =   CateArticles::where('group','mode')->get()->toArray();
        return view('products.edit',compact('product','files_images','category','modes'));
    }


    public function postupdate(Request $request)
    {
        $articles = $request->all();
        $articles['code']=$request->code;


        if(!isset($articles['categories']))
        {
            return redirect()->back()->withErrors('Bạn chưa chọn danh mục sản phẩm!');
        }

        if($articles['name']=='' || $articles['code']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tên hoặc mã sản phẩm!');
        }

        $linktype = Linktype::where('code','products')->first();
        $slug = $linktype->vn.'/'.khongdau(Input::get('name')).'-'.Str::slug(Input::get('code')).'.html';

        $lang = getCurrentSessionAppLocale();
        if($lang!='vn')
        {
            $slug = $linktype->en.'/'.khongdau(Input::get('name')).'-'.Str::slug(Input::get('code')).'.html';
        }
        $articles['slug']=$slug;
        $articles['slug_name']=Str::slug($request->name);
        /*$articles['slug_brand']=Str::slug($request->brand);*/

        $null = $this->productsRepository->ProductNullUpdate($request->name,$articles['code'],$request->id);

        if($null == false)
        {
            return redirect()->back()->withErrors('Sản phẩm đã tồn tại!');
        }

        $articles['cate_id'] = $request->categories;
        $articles['shortcate'] = $request->shortcate;
        $articles['longcate'] = $request->longcate;
        $jsonmode = json_encode($request->mode);
        $articles['mode'] = $jsonmode;

        $product = $this->productsRepository->ById($request->id);

        /* -------------------------------------- */

        if ($request->hasFile('input-image')) {
            $files = $request->file('input-image');
            foreach($files as $key=>$file){
                $sp = $request->name;
                $name = 'img-'.str_slug($sp).$key.'.'.$file->getClientOriginalExtension();
                if($key==0){
                    $name = $request->code.'.'.$file->getClientOriginalExtension();
                    $daidien = $name;
                    $articles['images']=$daidien;
                }
                $path = 'products/'.$articles['code'].'/'.$name;
                FileUtils::save_images($path,$file, 375, null);
            }
        }

        $this->productsRepository->update($product,$articles);

        /* Cập nhật link menu khi đổi thay đổi thư mục */
        $menu = SupperMenus::where('url',$request->id)->first();
        if($menu!=null)
        {
            $menu->link = $product->slug;
            $menu->save();
        }
        return redirect()->back()->with('status','Đã sửa sản phẩm thành công!');
    }


    public function delete($id)
    {
        // see if authenticated user has permission to delete users
        if (!hasPermission('product_management', true)) return back();

        $aPro = Products::find($id);
        $count = $this->hasmenus($id,$aPro->group);
        if($count!=0){
            return Redirect::back()->with('flash_message', 'Không thể xóa Sản phẩm do tồn tại Menus trỏ tới Sản phẩm!');
        }

        $productsApplicationService = new ProductsApplicationService();
        $productsApplicationService->delete($id);
        $apro = Products::find($id);
      /*  $path = public_path().'/images/products/'.$apro->code;
        FileUtils::delete_folderfiles($path);*/
        Flash::success(trans('VNPCMS.messages.models.delete.success', ['modelname' => trans('Sản phẩm')]));

        return back();
    }

    public function deleteall($slug_name)
    {
        // see if authenticated user has permission to delete users
        if (!hasPermission('product_management', true)) return back();

        $productsApplicationService = new ProductsApplicationService();
        $productsApplicationService->deleteall($slug_name);

        Flash::success(trans('VNPCMS.messages.models.delete.success', ['modelname' => trans('Sản phẩm')]));

        return back();
    }

    public function ajax_images(Request $request)
    {
        $data = Input::all();
        $path = 'public/images/'.$data['link'];
        FileUtils::delete_files( $path);
        $msg = "Xóa hình ảnh thành công!";
        return response()->json(array('msg'=> $msg), 200);
    }

    public function import(){
        $cates = App::make(CateArticlesRepositoryInterface::class);
        $cates = $cates->getData('products');
        return view('products.import',compact('cates'));
    }

    public function postimport(Request $request){

        $cateid = $request->get('categories');
       if($cateid==null){
           return redirect()->back()->with(['flash_level' => 'danger','flash_message' =>'Chưa chọn danh mục sản phẩm!']);
       }

        if($request->hasFile('input_file')){
            $path = $request->file('input_file')->getRealPath();
            ini_set('max_execution_time',180);
            ini_set('max_input_time',120);
                $data = Excel::load($path, function($reader) {})->get();
                $Total=0;
                $Repeat=0;
                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {
                        if(!empty($value)){
                         $count = $this->CheckCode($value['code']);
                          if($count==0){
                                $this->importonly($value,$cateid);
                                $Total++;
                           }
                          else
                            {
                                $id = $this->GetId($value['code']);
                                $this->updateonly($value,$id);
                                $Repeat++;
                            }
                        }
                    }
                }
            return back()->with(['flash_level' => 'success','flash_message' =>$Total.' bản ghi thêm mới và '.$Repeat.' bản ghi sửa đổi']);
        }
        return redirect()->back()->with(['flash_level' => 'danger','flash_message' =>'Không tồn tại Sheet dữ liệu!']);
    }

    public function CheckCode($code)
    {
        $count = Products::where('code',$code)->count();
        return $count;
    }

    public function GetId($model,$color,$size)
    {
        $id = Products::where('model',$model)->where('color',$color)
            ->where('size',$size)->first()->id;
        return $id;
    }

    public function importonly($value,$cateid)
    {
        $lang = getCurrentSessionAppLocale();
        $product = new Products();
        $product->model =$value['code'];
        $product->code =$value['code'];
        $product->images ="anhdaidien.jpg";
        $product->name =$value['name'];
        $linktype = Linktype::where('code','products')->first();
        $slug = $linktype->vn.'/'.khongdau($value['name']).'-'.Str::slug($value['code']).'.html';
        $product->slug=$slug;
        $product->quantity =$value['quantity'];
        $product->cate_id =$cateid;
        $product->status =1;
        $product->locale =$lang;
        $product->user_id =Auth::user()->id;
        $product->slug_name=Str::slug($value['name']);
        $product->save();
        $path = 'products/'.$product->model;
        FileUtils::save_folderimages($path);
    }

    public function updateonly($value,$id)
    {
        $lang = getCurrentSessionAppLocale();
        $product = Products::find($id);
        $product->model =$value['code'];
        $product->code =$value['code'];
        $product->images ="anhdaidien.jpg";
        $product->name =$value['name'];

        $linktype = Linktype::where('code','products')->first();
        $slug = $linktype->vn.'/'.khongdau($value['name']).'-'.Str::slug($value['code']).'.html';
        $product->slug=$slug;
        $product->quantity =$value['quantity'];
        $product->status =1;
        $product->locale =$lang;
        $product->user_id =Auth::user()->id;
        $product->slug_name=Str::slug($value['name']);
        $product->save();
    }
    public function aupdate(Request $request)
    {
        $aProduct = Products::find($request->id);
        $aProduct->price = $request->price;
        $aProduct->quantity = $request->quantity;
        $aProduct->save();
        return back()->with(['flash_level' => 'success','flash_message' =>'Cập nhật sản phẩm thành công!']);
    }
    public function seach(Request $request)
    {
        $cates = App::make(CateArticlesRepositoryInterface::class);
        $cates = $cates->getData('products');
        $cate = $request->categories;
        $cate = CateArticles::find($cate);
        $categories = $cate->mergechildren($cate->id);
        $seach = $request->get('nameseach');
        $products = Products::where(function ($query) use ($categories,$seach){
            if($categories!=null) {
                $query->whereIn('cate_id', $categories);
            }
            if($seach!=""){
                $query->where('name','LIKE','%'.$seach.'%');
                $query->orwhere('code','LIKE','%'.$seach.'%');
                $query->orwhere('brand','LIKE','%'.$seach.'%');
            }
        })
            ->orderby('id','desc')
            ->groupBy('products.name')
            ->paginate(25);
        return  view('products.seach',compact('products','cates'));
    }

}