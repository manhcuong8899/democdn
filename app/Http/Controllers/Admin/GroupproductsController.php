<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groupproducts;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use VNPCMS\Catearticle\CateArticles;
use Illuminate\Support\Facades\Response;
use VNPCMS\Products\Products;

class GroupproductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    public function index(Request $request)
    {
        $groups = Groupproducts::orderBy('id','desc')->get();
        return view('groupproducts.index',compact('groups'));
    }


    public function postcreate(Request $request)
    {
        $articles=$request->all();

        if($request->name=="")
        {
            return redirect()->back()->withErrors('Chưa điền nhóm sản phẩm!');
        }

        if($request->data=='0')
        {
            return redirect()->back()->withErrors('Chưa lựa chọn loại dữ liệu hiển thị!');
        }

        if($request->data=='categories'&& empty($request->group_cate))
        {
            return redirect()->back()->withErrors('Chưa lựa chọn danh mục sản phẩm gán vào nhóm sản phẩm');
        }


        if($request->data=='products'&& empty($request->group_product))
        {
            return redirect()->back()->withErrors('Chưa lựa chọn sản phẩm gán vào nhóm sản phẩm');
        }

        if(empty($request->group_cate)==false)
        {
            $jsongroup_cate = json_encode($request->group_cate);
            $articles['group_cate'] =$jsongroup_cate;
        }

        if(empty($request->group_product)==false)
        {
            $jsongroup_product = json_encode($request->group_product);
            $articles['group_product'] =$jsongroup_product;
        }
        $articles['slug']= Str::slug($request->name);

            Groupproducts::create($articles);

        return redirect()->back()->with('status','Tạo nhóm sản phẩm thành công!');
}

    public function edit(Request $request)
    {
        $gp = Groupproducts::find($request->id);
        $groups = Groupproducts::orderBy('created_at','desc')->get();
        return view('groupproducts.edit',compact('gp','groups'));
    }

    public function postupdate(Request $request)
    {
        $articles=$request->all();
        $group = Groupproducts::find($request->id);

        if($request->name=="")
        {
            return redirect()->back()->withErrors('Chưa điền tên nhóm sản phẩm');
        }

        if($request->data!='0')
        {

            if($request->data=='categories'&& empty($request->group_cate))
            {
                return redirect()->back()->withErrors('Chưa lựa chọn danh mục sản phẩm gán vào nhóm');
            }


            if($request->data=='products'&& empty($request->group_product))
            {
                return redirect()->back()->withErrors('Chưa lựa chọn sản phẩm gán vào nhóm');
            }

            if(empty($request->group_cate)==false)
            {
                $jsongroup_cate = json_encode($request->group_cate);
                $articles['group_cate'] =$jsongroup_cate;
            }

            if(empty($request->group_product)==false)
            {
                $jsongroup_product = json_encode($request->group_product);
                $articles['group_product'] =$jsongroup_product;
            }

            /* Resset lại các giá trị theo nội dung data thay đổi */
            if($request->data=='categories') {

                $articles['group_product']=0;
            }
            else{
                $articles['group_cate']=0;
            }
            $articles['slug']= Str::slug($request->name);
            $group->update($articles);
            return redirect()->back()->with('status','Cập nhật nhóm sản phẩm thành công');
        }


        $group->name = $request->name;
        $group->slug = Str::slug($request->name);
        $group->status = $request->status;
        $group->save();
        return redirect()->back()->with('status','Cập nhật nhóm sản phẩm thành công');

    }

    public function delete(Request $request)
    {
       Groupproducts::find($request->id)->delete();
        return redirect('admin/groupproducts')->with('status','Xóa nhóm sản phẩm thành công!');
    }

}
