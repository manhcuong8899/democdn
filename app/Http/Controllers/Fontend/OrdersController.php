<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\Profile;
use App\Models\User;
use Cart;
use Illuminate\Support\Facades\Auth;
use VNPCMS\Banks\Banks;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use VNPCMS\Orders\OrderDetail;
use VNPCMS\Orders\Orders;
use VNPCMS\Products\Products;
use Illuminate\Support\Facades\Response;
use VNPCMS\Setting\Setting;


class OrdersController extends Controller
{

    public function postorder(Request $request)
    {
        $cart =  Cart::instance('cart')->content();
        $total = getTotal($cart);
        $coupons = getDownprice($cart);
        $input = $request->all();

        $phone = $request->phone;

        $user = Auth::user();
        if(validatePhone($phone)==false){
            return Redirect()->back()->withErrors('Định dạng số điện thoại không đúng!')->withInput();
        }
/* check thông tin đầu vào table order */
        $phone = format_phone($phone);
        $input['phone'] = $phone;
        $nullphone = Profile::where('phone',$phone)->get()->count();
        $input['customer_id']=$user->id;

        if($request->emailbill==''){
            $input['emailbill'] = $request->email;
        }
        if($request->phonepay==''){
            $input['phonepay'] = $phone;
        }
        if($request->phone2pay==''){
            $input['phone2pay'] = $phone;
        }
        /* Gán thông tin hóa đơn*/

         $input['total'] = $total;
         $input['discount'] = $coupons;
        $code = createRandomCoupons();
        $input['code'] = $code;
        $input['status'] = 1;
        /* Tạo dữ liệu bảng order*/
        $order = Orders::create($input);

        /* Tạo dữ liệu bảng chi tiết order*/
        foreach($cart as $index=>$value)
        {
            $data = array(
                 'order_id'=>$order->id,
                 'product_id'=>$value->id,
                 'price'=>$value->price,
                 'quantity'=>$value->qty,
                 'totalprice'=>$value->price*$value->qty,
                 'size'=>$value->options->size,
                 'weight'=>$value->options->weight,
                 'color'=>$value->options->color,
                 'coupon'=>$value->options->coupons,
                 'fee'=>$value->options->ship,
                );
            OrderDetail::create($data);
        }
        if(session()->has('counpons')==true){
        $idcoupon = Session::get('counpons')[0]['id'];
        $setcoupon = Coupons::find($idcoupon);
        if($setcoupon->quantity>0){
            $setcoupon->quantity = $setcoupon->quantity-1;
            $setcoupon->save();
        }
        }
        Cart::instance('cart')->destroy();
        Session::forget('counpons');
        return redirect('successorder');

    }

}