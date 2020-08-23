<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
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
use VNPCMS\Products\Products;
use Illuminate\Support\Facades\Response;
use VNPCMS\Setting\Setting;


class CartController extends Controller
{

    public function index()
    {
        $cart = Cart::instance('cart')->content();
        $total = getTotal($cart);
        $coupons = getDownprice($cart);
        return view('themes.products.cart',compact('cart','total','coupons'));
    }


    public function checkout()
    {
        $cart = Cart::instance('cart')->content();
       if(session()->has('cart')==false){
           return redirect()->back()->withErrors('Giỏ hàng rỗng không thể thanh toán!');
       }
        $total = getTotal($cart);
        $coupons = getDownprice($cart);
        $banks = Banks::where('customer_id',0)->get();
        return view('themes.products.checkout',compact('cart','total','coupons','banks'));
    }
    /* ---------Thêm sản phẩm vào giỏ hàng ------------ */
    public function addcart(Request $request)
    {
        $p = Products::find($request->productid);
        $CartItem = Cart::instance('cart')->add($p->id,$p->name,$request->quantity,
            $p->price,[
                'code'=> $p->code,
                'model'=>$p->model,
                'slug'=> $p->slug,
                'images'=> $p->images,
                'coupons'=>0,
            ]);
        $cart = Cart::instance('cart')->content();
        $total = getTotal($cart);
        $count = Cart::instance('cart')->content()->count();
        $data = array(
            'name'=>$p->name,
            'code'=>$p->code,
            'quantity'=>$request->quantity,
            'images'=>asset('public/images/products/'.$p->code.'/'.$p->images),
            'quantitycart'=>$request->quantity.' Sản phẩm',
            'pricecart'=>number_format($request->quantity*$p->price,0,',','.'),
            'totalcart'=>number_format($request->quantity*$p->price,0,',','.'),
            'total'=>$count,
	        'totalcartship'=>number_format(($request->quantity*$p->price),0,',','.'),
        );

        return response::json($data);
    }

    public function deleteitem(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        $count = Cart::content()->count();
        $redirect = url('cart');
        return response($redirect);

    }

    public function updateitem(Request $request)
    {
        $quantity = trim($request->newquantity);
        $rowId = $request->rowId;
        $CartItem = Cart::instance('cart')->get($rowId);
        $apro = $CartItem->id;
        $product = Products::find($apro);
        /* Update giảm giá */
        $cart = Cart::instance('cart')->content();
        Cart::instance('cart')->update($rowId,[
            'id'=>$product->id,
            'qty' => $quantity,
            'price'=>$product->price,
            'options'=>array(
                'code'=> $product->code,
                'model'=>$product->model,
                'slug'=> $product->slug,
                'images'=> $product->images,
                'coupons'=>0,
            )
        ]);
        $this->Getcoupon($cart);
        $redirect = url('cart');
        return response($redirect);
    }

    private  function Getcoupon($cart){
        if(Session::has('counpons')){
            $catecoupon = Session::get('counpons')[0]['data'];
            $groupcate = Session::get('counpons')[0]['group_cate'];
            $groupproduct = Session::get('counpons')[0]['group_product'];
            $off = Session::get('counpons')[0]['value'];
            foreach($cart as $index=>$value)
            {
                $check =true;
                $pr = Products::find($value->id);

                    if($catecoupon == 'categories'){
                        $check = CateCoupon($groupcate,$pr->cate_id);
                    }
                if($catecoupon == 'products'){
                        $check = ProductCoupon($groupproduct,$pr->id);
                    }

                if($check==true) {
                    Cart::instance('cart')->update($index,[
                        'options'=>array(
                            'code'=> $value->options->code,
                            'model'=> $value->options->model,
                            'slug'=> $value->options->slug,
                            'images'=> $value->options->images,
                            'coupons'=>($off/100)*$pr->price*$value->qty,
                        )
                    ]);
                }
            }
        }
    }
}