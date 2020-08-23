<?php
/**
 * Created by PhpStorm.
 * User: CUONGHM
 * Date: 8/22/2016
 * Time: 8:55 AM
 */

namespace Fully\Utils;
use Fully\Models\Ordetail;
use Fully\Models\Product;
use Fully\Utils\Products;
use Fully\Models\Order;
use Cart;
use Illuminate\Support\Facades\Lang;


class Orders {

    public static  function createOrder($data)
    {
        $order = array();
        foreach($data as $index =>$value)
        {
            $order[$index] = $value;
        }

        return Order::create($order);
    }

    public static  function createOrdetail($data)
    {
        $ordetail = array();
        foreach($data as $index =>$value)
        {
            $ordetail[$index] = $value;
        }

        return Ordetail::create($ordetail);
    }


    public  static function  createCode()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = getdate();

        $currentTime = $now["hours"] . ":" . $now["minutes"] . ":" . $now["seconds"];
        $currentDate = $now["mday"] . "." . $now["mon"] . "." . $now["year"];

        $pieces = explode(".", $currentDate);
        $pieces1 = explode(":", $currentTime);

        $day= $pieces[0]; // piece1
        $month = $pieces[1]; // piece2
        $year = $pieces[2]; // piece2
        $hour= $pieces1[0]; // piece1
        $minute = $pieces1[1]; // piece2
        $second = $pieces1[2]; // piece2
        $code="KH".$day.$month.$year.$hour.$minute.$second;

        return $code;

    }

    public  static function  insert_Ordetail($order_id,$order_code)
    {
        $cart = Cart::content();

        foreach($cart as $index=>$value)
        {
            $CartItem = Cart::get($index);
            $item_product = Product::find($CartItem->id)->firstOrFail();

            if($CartItem->qty <= $item_product->quantity)
            {
                    $formData = array(
                    'order_id' =>$order_id,
                    'order_code' =>$order_code,
                    'product_id' =>$CartItem->id,
                    'product_code' =>$CartItem->options->code,
                    'device_id' =>$CartItem->options->device_id,
                    'price' =>$CartItem->price,
                    'quantity'=>$CartItem->qty,
                    'warranty' =>$CartItem->options->warranty,
                    'saleoff' =>$CartItem->options->saleoff,
                    'lang'   =>getLang(),
                );
                Orders::createOrdetail($formData);
                $new_quantity = $item_product->quantity - $CartItem->qty;
               Product::find($CartItem->id)->update(array('quantity'=>$new_quantity));
            }
        }
    }

    public  static function get_status($order_code)
    {
       $order = Order::where('code',$order_code)->first();
        $status = $order->status;
        $shipper = $order->is_shipper;
        switch($status)
        {
            case 0:
                switch($shipper)
                {
                    case 0:
                        $status_name=Lang::get('fully.wait_pickup');
                        break;
                    case 1:
                        $status_name=Lang::get('fully.wait_ship');
                        break;
                    case 2:
                        $status_name=Lang::get('fully.Shipping');
                        break;
                }
                break;
            case 1:
                if($shipper==3)
                {
                    $status_name=Lang::get('fully.successful_delivery');
                }
                else
                {
                    $status_name=Lang::get('fully.complete');
                }

                break;
            case 2:
                switch($shipper)
                {
                    case 4:
                        $status_name=Lang::get('fully.return_order');
                        break;
                    default:
                        $status_name=Lang::get('fully.cancer');
                        break;
                }
                break;
        }
        return $status_name;
    }

    public  static function change_orname($order_code)
    {
        $btn_name="";
        $order = Order::where('code',$order_code)->first();
        $status = $order->status;
        $shipper = $order->is_shipper;
        switch($status)
        {
            case 0:
                switch($shipper)
                {
                    case 0:
                        $btn_name=Lang::get('fully.complete');
                        break;
                    case 1:
                        $btn_name=Lang::get('fully.Shipping');
                        break;
                    case 2:
                        $btn_name=Lang::get('fully.delivery');
                        break;
                }
                break;
        }
        return $btn_name;
    }

    public  static function get_invoice($order_code)
    {
        $order = Order::where('code',$order_code)->first();
        $invoice = $order->is_invoice;

        switch($invoice)
        {
            case 0:
                $invoice_name="No invoice";
                break;
            case 1:
                $invoice_name="Get invoice";
                break;
            case 2:
                $invoice_name="Complete";
                break;
        }
        return $invoice_name;


    }

    public  static function get_total($order_code)
    {
        $detail = Ordetail::where('order_code',$order_code)->get();
        $total = 0;
        $subtotal = 0;
        foreach($detail as $index=>$details)
        {
            $subtotal = $details->price*$details->quantity*((100-$details->saleoff)/100);
            $total+=$subtotal;
        }

        return $total;


    }




}