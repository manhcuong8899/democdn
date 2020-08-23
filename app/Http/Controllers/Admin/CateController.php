<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupperMenus;
use Flash;
use Illuminate\Http\Request;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use VNPCMS\Catearticle\CateArticlesApplicationService;
use VNPCMS\Catearticle\CateArticles;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use App\Models\Linktype;
use Google\Cloud\Translate\TranslateClient;
use Illuminate\Support\Facades\Redirect;

class CateController extends Controller
{
    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $catesRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CateArticlesRepositoryInterface $cateRepository)
    {
        $this->catesRepository = $cateRepository;
        $this->middleware('auth');
        $this->middleware('permission:categories_management');
    }

    /**

     *
     * @return View;
     **/
    public function show(Request $request)
    {
        $parent =0;
        if($request->parent!=null)
        {
            $parent = $request->parent;
            $viewparent = CateArticles::find($parent);
        }
        $group = $request->group;
        $listCate = $this->catesRepository->getByGroup($group,$parent);
        $data = $this->catesRepository->getData($group);
        $groupmenus = CateArticles::where('group','=','menus')->get();
        $type = Linktype::where('code',$group)->first();
        if($parent==0)
        {
            return view('cate.index',compact('listCate','group','data','groupmenus','type','parent'));

        }else{
            return view('cate.index',compact('listCate','group','data','groupmenus','type','parent','viewparent'));

        }
    }

    public function postcreate(Request $request)
    {
        $attributes = $request->all();
        $attributes['group']=$request->group;
        $attributes['locale'] = getCurrentSessionAppLocale();

        $attributes['code']=khongdau($request->code);

        $linktype = Linktype::where('code',$request->group)->first();
        if($linktype!=null)
        {
            $slug = $linktype->vn.'/'.Str::slug(Input::get('name'));
            $lang = getCurrentSessionAppLocale();
            if($lang!='vn')
            {
                $slug = $linktype->en.'/'.Str::slug(Input::get('name'));
            }
            $attributes['slug']=$slug;

            if($request->parent_id!=0)
            {
                $parent_slug = CateArticles::find($request->parent_id)->slug;
                $attributes['parent_slug']=$parent_slug;
              /*  $slug = $parent_slug.'-'.Str::slug(Input::get('name'));*/
               /* $attributes['slug']=$slug;*/
            }
            else
            {
                $attributes['parent_slug']="";
            }
        }

       /* $code = CateArticles::where('code',$attributes['code'])->count();

        if($code!=0)
        {
            return redirect()->back()->withErrors('Trùng tên hoặc mã danh mục!');
        }*/
        if($request->hasFile('images')) {
            $file = $request->file('images');
            $name = Str::slug($attributes['name'])."." . $file->getClientOriginalExtension();
            $path = 'public/images/categories/'.$request->group.'/';
            $attributes['images']=$name;
            $file->move($path, $name);
        }

        $this->catesRepository->create($attributes);

        return redirect()->back()->with('status','Đã tạo danh mục thành công!');
    }

    public function showupdate(Request $request)
    {
        $group = $request->group;
        $type = Linktype::where('code',$group)->first();
        $id = $request->id;
        $cate = $this->catesRepository->ById($id);
        $listCate = $this->catesRepository->getByGroup($group,$cate->parent_id);
        $data = $this->catesRepository->getData($group);

        if($cate->parent_id!=0)
        {
            $parent = CateArticles::find($request->parent);
            return view('cate.edit',compact('group','cate','listCate','data','type','parent'));
        }
        return view('cate.edit',compact('group','cate','listCate','data','type'));
    }

    public function update(Request $request)
    {
        $attributes = $request->all();
        $attributes['group']=$request->group;
        $linktype = Linktype::where('code',$request->group)->first();
        if($linktype!=null)
        {
            $slug = $linktype->vn.'/'.Str::slug(Input::get('name'));
            $lang = getCurrentSessionAppLocale();
            if($lang!='vn')
            {
                $slug = $linktype->en.'/'.Str::slug(Input::get('name'));
            }
            $attributes['slug']=$slug;

        /*    $count = CateArticles::where('code',$request->code)->where('id','!=',$request->id)->count();
            if($count!=0)
            {
                return redirect()->back()->withErrors('Trùng tên danh mục!');
            }*/
            if($request->parent_id!=0)
            {
                $parent_slug = CateArticles::find($request->parent_id)->slug;
                $attributes['parent_slug']=$parent_slug;
             /*   $slug = $parent_slug.'-'.Str::slug(Input::get('name'));
                $attributes['slug']=$slug;*/
            }
            else
            {
                $attributes['parent_slug']="";
            }

        }
        $cate = $this->catesRepository->ById($request->id);

        if($request->hasFile('images')) {
            $file = $request->file('images');
            $name = Str::slug($attributes['name'])."." . $file->getClientOriginalExtension();
            $path = 'public/images/categories/'.$request->group.'/';
            $attributes['images']=$name;
            $file->move($path, $name);
        }

        $cates = $this->catesRepository->update($cate,$attributes);




        /* Cập nhật link menu khi đổi thay đổi thư mục */
            $menu = SupperMenus::where('url',$request->id)->first();
            if($menu!=null)
            {
                $menu->link = $cate->slug;
                $menu->save();
            }

        return redirect()->back()->with('status','Đã sửa danh mục thành công!');
    }


    public function delete($id)
    {
        $group = CateArticles::find($id)->group;
        // see if authenticated user has permission to delete users
        $count = $this->hasmenus($id,$group);
        if($count!=0){
            return Redirect::back()->with('flash_message', 'Không thể xóa danh mục do tồn tại Menus trỏ tới danh mục!');
        }

        if (!hasPermission('categories_management', true)) return back();

        $cateApplicationService = new CateArticlesApplicationService();
        $cateApplicationService->delete($id);

        Flash::success(trans('VNPCMS.messages.models.delete.success', ['modelname' => trans('VNPCMS.models.articles')]));
        return redirect('admin/cate/'.$group);
    }

    public function urlcategories(Request $request)
{
    $data = $request->data;
    $type = $request->type;
    $cates = $this->catesRepository->getData($type);
    $rendercates= cate_parent($cates);
    return response($rendercates);
}

    public function cateforproperty(Request $request)
    {
        $data = $request->data;
        $property = CateArticles::find($data);
        $cates = $this->catesRepository->getData('products');
        $rendercates= categories_properties($cates,0,"--",$property);
        return response($rendercates);
    }
    public function orders(Request $request)
    {
        $orders = $request->order;
        foreach($orders as $key=>$value){
            $update = CateArticles::find($key);
            $update->order = $orders[$key];
            $update->save();
        }
        return redirect()->back()->with('status','Đã cập nhật thành công!');

    }
}