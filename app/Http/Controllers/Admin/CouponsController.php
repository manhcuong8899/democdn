<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use VNPCMS\Catearticle\CateArticles;
use Illuminate\Support\Facades\Response;
use VNPCMS\Products\Products;

class CouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    public function index(Request $request)
    {
        $coupons = Coupons::orderBy('id','desc')->get();
        return view('coupons.index',compact('coupons'));
    }


    public function postcreate(Request $request)
    {
        $articles=$request->all();

        if($request->type=='0')
        {
            return redirect()->back()->withErrors('Bạn chưa lựa chọn loại mã giảm giá!');
        }

       if($request->type=='1'&& $request->quantity=="")
       {
           return redirect()->back()->withErrors('Chưa điền số lần sử dụng mã giảm giá!');
       }

        if($request->type=='2'&& $request->end_date=="")
        {
            return redirect()->back()->withErrors('Chưa điền thời gian kết thúc mã giảm giá!');
        }

        if($request->name=="")
        {
            return redirect()->back()->withErrors('Chưa điền tên chương trình giảm giá');
        }

        if($request->data=='0')
        {
            return redirect()->back()->withErrors('Chưa lựa chọn nội dung áp dụng giảm giá');
        }

        if($request->data=='categories'&& empty($request->group_cate))
        {
            return redirect()->back()->withErrors('Chưa lựa chọn danh mục sản phẩm áp dụng giảm giá');
        }


        if($request->data=='products'&& empty($request->group_product))
        {
            return redirect()->back()->withErrors('Chưa lựa chọn sản phẩm áp dụng giảm giá');
        }

        if(empty($request->group_cate==false))
        {
            $jsongroup_cate = json_encode($request->group_cate);
            $articles['group_cate'] =$jsongroup_cate;
        }

        if(empty($request->group_product==false))
        {
            $jsongroup_product = json_encode($request->group_product);
            $articles['group_product'] =$jsongroup_product;
        }
        if($request->data=='all')
        {
            $articles['group_product']=0;
            $articles['group_cate']=0;
        }
        $articles['code'] = createRandomCoupons();

            Coupons::create($articles);

        return redirect()->back()->with('status','Tạo mã giảm giá thành công!');
}

    public function edit(Request $request)
    {
        $coupon = Coupons::find($request->id);
        $coupons = Coupons::orderBy('created_at','desc')->get();
        return view('coupons.edit',compact('coupon','coupons'));
    }

    public function postupdate(Request $request)
    {
        $articles=$request->all();
        $coupon = Coupons::find($request->id);
        if($request->type=='0')
        {
            return redirect()->back()->withErrors('Bạn chưa lựa chọn loại mã giảm giá!');
        }

        if($request->type=='1'&& $request->quantity=="")
        {
            return redirect()->back()->withErrors('Chưa điền số lần sử dụng mã giảm giá!');
        }

        if($request->type=='2'&& $request->end_date=="")
        {
            return redirect()->back()->withErrors('Chưa điền thời gian kết thúc mã giảm giá!');
        }

        if($request->name=="")
        {
            return redirect()->back()->withErrors('Chưa điền tên chương trình giảm giá');
        }

        if($request->data!='0')
        {

            if($request->data=='categories'&& empty($request->group_cate))
            {
                return redirect()->back()->withErrors('Chưa lựa chọn danh mục sản phẩm áp dụng giảm giá');
            }


            if($request->data=='products'&& empty($request->group_product))
            {
                return redirect()->back()->withErrors('Chưa lựa chọn sản phẩm áp dụng giảm giá');
            }

            if(empty($request->group_cate==false))
            {
                $jsongroup_cate = json_encode($request->group_cate);
                $articles['group_cate'] =$jsongroup_cate;
            }

            if(empty($request->group_product==false))
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
            if($request->data=='all')
            {
                $articles['group_product']=0;
                $articles['group_cate']=0;
            }
            $coupon->update($articles);
            return redirect()->back()->with('status','Cập nhật mã khuyến mãi thành công');
        }


        $coupon->name = $request->name;
        $coupon->type = $request->type;
        $coupon->quantity = $request->quantity;
        $coupon->end_date = $request->end_date;
        $coupon->status = $request->status;
        if($request->type==1)
        {
            $coupon->end_date =0;
        }
        else
        {
            $coupon->quantity = 0;
        }
        $coupon->save();
        return redirect()->back()->with('status','Cập nhật mã khuyến mãi thành công');

    }

    public function delete(Request $request)
    {
        Coupons::find($request->id)->delete();
        return redirect('admin/coupons')->with('status','Xóa mã giảm giá thành công!');
    }

}
