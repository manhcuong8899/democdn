<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Groupproducts;
use App\Models\Join;
use App\Models\Join_mode;
use App\Models\Join_property;
use App\Models\Size;
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
use VNPCMS\Property\Properties;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductsController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $productsRepository;
    private $group = 'products';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductsRepositoryInterface $articlesRepository)
    {
        $this->productsRepository = $articlesRepository;
    }

    public function category(Request $request)
    {
        $page='list';
        $olink = "?order=";
        /* Xử lý khi ở trang seach */
        if($request->seach==true){
            $olink = "&order=";
            $page = 'seach';
            $curPageURL = curPageURL();
            $curPageURL = explode('?seach=', $curPageURL);
            $curl = $curPageURL[1];
            $curl = explode('&page', $curl);
            $curl = $curl[0];
        }
        /* Xử lý link chèn vào link get sắp xếp */
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $curPageURL = curPageURL();
        $curPageURL = explode($olink, $curPageURL);
        $curPageURL = explode('?page', $curPageURL[0]);
        $curPageURL = $curPageURL[0].$olink;

        $order = $request->order;

        if($order!=null && $request->seach==null){
            $page = 'order';
            $curPage= curPageURL();
            $curPage = explode('?order=', $curPage);
            $curl = $curPage[1];
            $curl = explode('&page', $curl);
            $curl = $curl[0];
        }
        $slug = $this->linktype($request->slug);
        $cate = CateArticles::where('slug',$slug)->first();

        if($request->seach==null){
            $seach=false;
        }else{
            $seach=true;
        }
        $data = array(
            'size'=>$request->size,
            'color'=>$request->color,
            );
           /*if($cate==null)
           {
               return redirect()->back()->withErrors('Địa chỉ không tồn tại!');
            }*/
        $listproducts = $this->productsRepository->ByCate($cate,$seach,$data,$order);

        $pageSize = $request->size;
        $pageColor = $request->color;
        $pview = Cart::content(10);
        $count = Cart::content()->count();
        $header = getHeader($cate->name, '', '');

        return view('themes.products.list',compact('cate','listproducts','actual_link','seach','data','curPageURL','page','pageSize','pageColor','pview','header','count'));

    }

    public function groups(Request $request)
    {
        $page='list';
        $olink = "?order=";
        /* Xử lý khi ở trang seach */
        if($request->seach==true){
            $olink = "&order=";
            $page = 'seach';
            $curPageURL = curPageURL();
            $curPageURL = explode('?seach=', $curPageURL);
            $curl = $curPageURL[1];
            $curl = explode('&page', $curl);
            $curl = $curl[0];
        }
        /* Xử lý link chèn vào link get sắp xếp */
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $curPageURL = curPageURL();
        $curPageURL = explode($olink, $curPageURL);
        $curPageURL = explode('?page', $curPageURL[0]);
        $curPageURL = $curPageURL[0].$olink;

        $order = $request->order;

        if($order!=null && $request->seach==null){
            $page = 'order';
            $curPage= curPageURL();
            $curPage = explode('?order=', $curPage);
            $curl = $curPage[1];
            $curl = explode('&page', $curl);
            $curl = $curl[0];
        }


        $slug = $this->linktype($request->slug);
        $cate = CateArticles::where('slug',$slug)->first();
        $group = Groupproducts::where('slug',$request->group)->first();

        if($request->seach==null){
            $seach=false;
        }else{
            $seach=true;
        }
        $data = array(
            'size'=>$request->size,
            'color'=>$request->color,
        );

      /*  if($group==null)
        {
            return redirect()->back()->withErrors('Địa chỉ không tồn tại!');
        }*/
        $listproducts = $this->productsRepository->ByGroup($group,$cate,$seach,$data,$order);

        $pageSize = $request->size;
        $pageColor = $request->color;


        return view('themes.products.list',compact('cate','listproducts','actual_link','seach','data','curPageURL','page','curl','pageSize','pageColor'));

    }

    public function detail(Request $request)
    {
          $slug = $this->linktypehtml($request->slug);
          $detailproduct = $this->productsRepository->GetDetail($slug);

        $cate = CateArticles::find($detailproduct->cate_id);
        $samename = Products::where('model',$detailproduct->model)->where('quantity','!=',0)->get();

// Add san pham da xem
        $watched = Cart::instance('watched')->add($detailproduct->id,$detailproduct->name,1,
            $detailproduct->price,[
                'code'=> $detailproduct->code,
                'model'=> $detailproduct->model,
                'slug'=> $detailproduct->slug,
                'images'=> $detailproduct->images,
            ]);


        $path ='products/'.$detailproduct->code;
        $files_images = Storage::disk('images')->files($path);
        $detailproduct->size = trim($detailproduct->size);
        $alsolikes = $this->productsRepository->ByAlso($detailproduct->cate_id);
        $title = $detailproduct->name.'-'. $detailproduct->code;
        $header = getHeader($title, $detailproduct->keywords, $detailproduct->description);
        $pview = Cart::instance('watched')->content(20);
        $countpview = Cart::instance('watched')->count();
        return view('themes.products.detail',compact('detailproduct',
            'samename',
            'files_images',
            'alsolikes',
            'cate',
            'samename',
            'header',
            'pview',
            'countpview'
        ));
    }

    private function linktype($slug)
    {
        $lang = getCurrentSessionAppLocale();
        /* Lấy Slug chuẩn theo danh mục sản phẩm */
        $linktype = Linktype::where('code',$this->group)->first();
        $slug = $linktype->vn.'/'.$slug;
        if($lang!='vn')
        {
            $slug = $linktype->en.'/'.$slug;
        }
        return $slug;
    }


    private function linkgroup($slug)
    {
        $lang = getCurrentSessionAppLocale();
        /* Lấy Slug chuẩn theo danh mục sản phẩm */
        $linktype = Linktype::where('code',$this->groupproducts)->first();
        $slug = $linktype->vn.'/'.$slug;
        if($lang!='vn')
        {
            $slug = $linktype->en.'/'.$slug;
        }
        return $slug;
    }

    private function linktypehtml($slug)
    {
        $lang = getCurrentSessionAppLocale();
        /* Lấy Slug chuẩn theo danh mục sản phẩm */
        $linktype = Linktype::where('code',$this->group)->first();
        $slug = $linktype->vn.'/'.$slug.'.html';
        if($lang!='vn')
        {
            $slug = $linktype->en.'/'.$slug.'.html';
        }
        return $slug;
    }


    public function size($id)
    {
        $cate = CateArticles::find($id);
        $catesize = Join_property::where('cate_id',$id)->where('type','size')->first()->property_id;
        $sizes = Size::where('cate_id',$catesize)->get();
        $first = Size::where('cate_id',$catesize)->first();
        if($first!=null){
            $title = json_decode($first->value,true);
        }
        return view('themes.products.size',compact('sizes','cate','title','first'));
    }


    public function groupproductss(Request $request)
    {
        $listgroups = Groupproducts::orderBy('order','asc')->get();
        $viewgroup = Groupproducts::where('slug',$request->slug)->first();

        return view('themes.products.group',compact('listgroups','viewgroup'));
    }

}