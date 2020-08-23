<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groupproducts;
use App\Models\Linktype;
use App\Models\SupperMenus;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use VNPCMS\Article\Articles;
use VNPCMS\Catearticle\CateArticles;
use Illuminate\Support\Facades\Response;
use VNPCMS\Products\Products;

class SupperMenusController extends Controller
{
    public function index(Request $request)
    {

        $type = CateArticles::where('code','=',$request->code)->firstOrFail();
        $menus = SupperMenus::orderBy('order','asc')->where('cate_id',$type->id)->where('parent_id','0')->get();
        $submenu=null;
        if($request->sub!=null)
        {
            $submenu = $request->sub;
            $submenu = SupperMenus::find($submenu);
            $menus = SupperMenus::orderBy('order','asc')->where('cate_id',$type->id)->where('parent_id',$request->sub)->get();
        }
        $typedata = Linktype::orderBy('name','asc')->get();
        return view('suppermenus.index',compact('menus','type','submenu','typedata'));
    }

    public function GetType(Request $request)
    {
        $groupmenus = SupperMenus::orderBy('order','asc')->where('cate_id',$request->data)->where('submenu','yes')->get()->ToArray();
        $groupmenus = cate_parent($groupmenus);
        return response($groupmenus);
    }

    public function postcreate(Request $request)
    {
        $articles=$request->all();
        if($request->name=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tên Menu!');
        }

        $null = SupperMenus::where('name',$request->name)->where('parent_id',$request->parent_id)->get()->count();

        if($null!=0){
           return redirect()->back()->withErrors('Trùng tên Menu cùng cấp!');
       }
        $type = CateArticles::where('code','=',$request->code)->firstOrFail();
        $articles['cate_id']=$type->id;

        /* Gán data và url là 0 khi ở type = custom*/
        if($request->type=='custom'){
            $articles['data']=0;
            $articles['url']=0;
        }
        /*  Xử lý lấy giá trị url theo danh mục và gán link cho menu*/

        if($request->url!=null && $request->article==null){
            $articles['url']=$request->url;
            $link = CateArticles::find($request->url)->slug;
            $articles['link']= $link;
        }

        /*  Xử lý lấy giá trị url theo bài viết và gán link cho menu*/

        if($request->url==null && $request->article!=null){
            $articles['url']=$request->article;

            if($request->type=='products')
            {
                if($request->data=='groups'){
                    $link = Groupproducts::find($request->article)->slug;
                }else{
                    $link = Products::find($request->article)->slug;
                }

            }else{
                $link = Articles::find($request->article)->slug;
            }
            $articles['link']= $link;
        }

        SupperMenus::create($articles);

        return redirect()->back()->with('status','Thêm menu thành công');
}

    public function edit(Request $request)
    {
        $menu = SupperMenus::find($request->id);
        $type = CateArticles::where('code','=',$request->code)->firstOrFail();
        $menus = SupperMenus::orderBy('order','asc')->where('cate_id',$type->id)->where('parent_id',$menu->parent_id)->get();
        $typedata = Linktype::orderBy('name','asc')->get();
        return view('suppermenus.edit',compact('menus','type','menu','typedata'));
    }

    public function postupdate(Request $request)
    {
        $articles=$request->all();


        $type = CateArticles::where('code','=',$request->code)->firstOrFail();
        $articles['cate_id']=$type->id;
        $menu = SupperMenus::find($request->id);


        $null = SupperMenus::where('name',$request->name)
            ->where('parent_id',$request->parent_id)
            ->where('id','!=',$request->id)
            ->get()->count();
        if($null!=0){
            return redirect()->back()->withErrors('Trùng tên Menu cùng cấp!');
        }

        /*  Xử lý lấy giá trị url theo danh mục và gán link là trống*/

        if($request->url!=null && $request->article==null){
            $articles['url']=$request->url;
            $link = CateArticles::find($request->url)->slug;
            $articles['link']=$link;
        }

        /*  Xử lý lấy giá trị url theo bài viết và gán link cho menu*/
        if($request->url==null && $request->article!=null){
            $articles['url']=$request->article;
            if($request->type=='products')
            {
                if($request->data=='groups'){
                    $link = Groupproducts::find($request->article)->slug;
                }else{
                    $link = Products::find($request->article)->slug;
                }
            }else{
                $link = Articles::find($request->article)->slug;
                if($request->data=='groups'){
                    $link = Groupproducts::find($request->article)->slug;
                }
            }
            $articles['link']=$link;
        }

        if($request->type=='custom'){
            $articles['data']=0;
            $articles['url']=0;
        }
        $menu->update($articles);
        return redirect()->back()->with('status','Cập nhật menu thành công');
    }

    public function delete(Request $request)
    {
        SupperMenus::find($request->id)->delete();
        return redirect()->back()->with('status','Xóa thành công menus');
    }

    public function orders(Request $request)
    {
        $orders = $request->order;
        foreach($orders as $key=>$value){
            $update = SupperMenus::find($key);
            $update->order = $orders[$key];
            $update->save();
        }
        return redirect()->back()->with('status','Đã cập nhật thành công!');

    }

}
