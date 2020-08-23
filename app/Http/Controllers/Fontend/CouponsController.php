<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use VNPCMS\Catearticle\CateArticles;
use Illuminate\Support\Facades\Response;
use VNPCMS\Products\Products;
use Cart;
use Illuminate\Support\Facades\Session;
class CouponsController extends Controller
{
    public function coupons(Request $request)
    {
        $nowdate = Carbon::now();

        $check = Coupons::where('code',$request->code)->first();

        if($check==null)
        {
            $status = 'false';
            return response($status);
        }

        if($check->type==1)
        {
            if($check->quantity==0){
                $status= 'false';
                return response($status);
            }
        }
        if($check->type==2)
        {
            if($check->end_date<$nowdate){
                $status= 'false';
                return response($status);
            }
        }

        if($check->type==3)
        {
            if($check->quantity==0 ||$check->end_date < $nowdate){
                $status= 'false';
                return response($status);
            }
        }

        $getcoupons = array(
            'id'=>$check->id,
            'code'=>$check->code,
            'name'=>$check->name,
            'type'=>$check->type,
            'data'=>$check->data,
            'value'=>$check->value,
            'group_cate'=>$check->group_cate,
            'group_product'=>$check->group_product
        );
        session()->push('counpons',$getcoupons);

        /* Update giảm giá */
        $cart =  Cart::instance('cart')->content();
        $this->Getcoupon($cart);
        $status = 'true';
        return response($status);
    }

    public function cancercoupons()
    {
        session()->forget('counpons');

        $cart = Cart::instance('cart')->content();
        foreach($cart as $index=>$value){
            Cart::instance('cart')->update($index,[
                    'options'=>array(
                        'code'=> $value->options->code,
                        'model'=> $value->options->model,
                        'slug'=> $value->options->slug,
                        'images'=> $value->options->images,
                        'coupons'=>0,
                    )
                ]);

        }
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
                $pr = Products::find($value->id);
                $check=true;
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




