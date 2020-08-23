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
use VNPCMS\Images\Images;
use VNPCMS\Images\ImagesApplicationService;
use VNPCMS\Images\Repository\ImagesRepositoryInterface;

class ImagesController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $imagesRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ImagesRepositoryInterface $imagesRepository)
    {
        $this->imagesRepository = $imagesRepository;
        $this->middleware('auth');
      $this->middleware('permission:image_management');
    }

    /**

     *
     * @return View;
     **/
    public function index()
    {
        $cates = CateArticles::where('group','images')->get();
        $images = $this->imagesRepository->getAll();
        return view('images.index',compact('images','cates'));
    }

    public function seach(Request $request)
    {
        $categories =$request->get('categories');
        $cates = CateArticles::where('group','images')->get();
        $images = $this->imagesRepository->getSeach($categories);

        return view('images.index',compact('images','cates'));
    }

    public function create()
    {
        $cates = CateArticles::where('group','images')->get();
        return view('images.create',compact('cates'));
    }


    public function postcreate(Request $request)
    {
        $articles=$request->all();
        if(!isset($articles['categories']))
        {
            return redirect()->back()->withErrors('Bạn chưa chọn chủ đề!');
        }

        if($articles['name']=='' || $articles['url']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tên hoặc liên kết!');
        }

        $articles['locale'] = getCurrentSessionAppLocale();

        $articles['images']=null;
        $articles['cate_id'] = $request->categories;
        $cate = CateArticles::find($request->categories);
        if($request->hasFile('images')) {
            $file = $request->file('images');
            $name = Str::slug($articles['name'])."." . $file->getClientOriginalExtension();
            $path = 'public/images/images/'.$cate->code.'/';
            $articles['images']=$name;
            $file->move($path, $name);
        }

        $this->imagesRepository->create($articles);

        return redirect()->back()->with('status','Bạn đã thêm hình ảnh thành công');

    }

    public function edit(Request $request)
    {
        $image = $this->imagesRepository->ById($request->id);
        $category =  CateArticles::find($image->cate_id);
        $cates =  CateArticles::where('group','images')->where('id','!=',$image->cate_id)->get();
        return view('images.edit',compact('image','category','cates'));
    }


    public function postupdate(Request $request)
    {
        $articles=$request->all();
        if(!isset($articles['categories']))
        {
            return redirect()->back()->withErrors('Bạn chưa chọn chủ đề!');
        }

        if($articles['name']=='' || $articles['url']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tên hoặc liên kết!');
        }

        $articles['locale'] = getCurrentSessionAppLocale();
        $articles['cate_id'] = $request->categories;
        $cate = CateArticles::find($request->categories);

        if($request->hasFile('images')) {
            $file = $request->file('images');
            $name = Str::slug($articles['name'])."." . $file->getClientOriginalExtension();
            $path = 'public/images/images/'.$cate->code.'/';
            $articles['images']=$name;
            $file->move($path, $name);
        }
        $article = $this->imagesRepository->ById($request->id);

        $this->imagesRepository->update($article,$articles);

        return redirect()->back()->with('status','Đã sửa hình ảnh thành công!');
    }


    public function delete($id)
    {
        // see if authenticated user has permission to delete users

        $imagesApplicationService = new ImagesApplicationService();
        $imagesApplicationService->delete($id);

        Flash::success('Xóa hình ảnh thành công!');

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

    public function orders(Request $request)
    {
        $orders = $request->order;
        foreach($orders as $key=>$value){
            $update = Images::find($key);
            $update->order = $orders[$key];
            $update->save();
        }
        return redirect()->back()->with('status','Đã cập nhật thành công!');

    }

}