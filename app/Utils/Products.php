<?php
/**
 * Created by PhpStorm.
 * User: CUONGHM
 * Date: 8/21/2016
 * Time: 5:23 PM
 */

namespace Fully\Utils;
use Fully\Models\Article;
use Fully\Models\Product;
use Illuminate\Support\Facades\Lang;
use Fully\Models\Manufacturer;
use Fully\Models\Quantity;
use Fully\Models\Money;


class Products {

    /* Get name Unit */
    public static function get_unit($articleid)
    {

        $unit_name = array(
            'manufacturer' => '',
            'uquantity' => '',
            'umoney' => '',
        );

        $parameter = Product::where('article_id', $articleid)->firstOrFail();
        if ($parameter->manufacturer_id != 0) {
            $unit_name['manufacturer'] = Manufacturer::find($parameter->manufacturer_id)->name;
        }
        if ($parameter->uquantity_id != 0) {
            $unit_name['uquantity'] = Quantity::find($parameter->uquantity_id)->name;
        }

        if ($parameter->umoney_id != 0) {
            $unit_name['umoney'] = Money::find($parameter->umoney_id)->name;
        }

        return $unit_name;

    }

    /* Get Parameter array product */
    public static function get_parameter($article)
    {
        foreach($article as $index=>$value)
        {
            $parameter[$value->id] = Product::where('article_id',$value->id)->firstOrFail();
            $unit_name[$value->id] = Products::get_unit($value->id);
            $article[$index]['code'] = $parameter[$value->id]->code;
            $article[$index]['price'] = $parameter[$value->id]->price;
            $article[$index]['saleoff'] = $parameter[$value->id]->saleoff;
            $article[$index]['quantity'] = $parameter[$value->id]->quantity;
            $article[$index]['uquantity'] = $unit_name[$value->id]['uquantity'];
            $article[$index]['umoney'] = $unit_name[$value->id]['umoney'];
            $article[$index]['brand'] = $unit_name[$value->id]['manufacturer'];
            $article[$index]['warranty'] = $parameter[$value->id]->warranty;
            $article[$index]['device_id'] = $parameter[$value->id]->device_id;
        }

        return $article;
    }

    /* Check Quantity */

    public static function check_quantity($id) {
        $status = array();
        $parameter = Product::where('article_id',$id)->firstOrFail();
        $unit_name[$id] = Products::get_unit($id);
        if( $parameter->quantity==0)
        {
            $status['name'] =
            $status['name'] = "<b><font color='red'>".Lang::get('fully.outofgoods').":</font> ".Lang::get('fully.quantity')." :</b> <font color='#000000'> ".$parameter->quantity." "
                .Lang::get('fully.product')."</font><b>&nbsp;&nbsp;&nbsp;&nbsp;".Lang::get('fully.price')."</b>:<font color='#000000'> ".number_format($parameter->price,0, '.', ',')." ".$unit_name[$id]['umoney']."/".$unit_name[$id]['uquantity'];

            $status['check'] = false;
        }
        else
        {
            $status['name'] = "<b><font color='blue'>".Lang::get('fully.available').":</font> ".Lang::get('fully.quantity')." :</b> <font color='#ff0000'> ".$parameter->quantity." "
                .Lang::get('fully.product')."</font><b>&nbsp;&nbsp;&nbsp;&nbsp;".Lang::get('fully.price')."</b>:<font color='#ff0000'> ".number_format($parameter->price,0, '.', ',')." ".$unit_name[$id]['umoney']."/".$unit_name[$id]['uquantity'];
            $status['check'] = true;
        }
        return $status;
    }


    /* Get get_parameter one Product */
    public static function pro_parameter($id)
    {
            $product = array();
            $article = Article::find($id);
            $parameter = Product::where('article_id',$id)->firstOrFail();
            $unit_name = Products::get_unit($id);
            $product['name'] = $article->name;
            $product['code'] = $parameter->code;
            $product['price'] = $parameter->price;
            $product['saleoff'] = $parameter->saleoff;
            $product['quantity'] = $parameter->quantity;
            $product['uquantity'] = $unit_name['uquantity'];
            $product['umoney'] = $unit_name['umoney'];
            $product['brand'] = $unit_name['manufacturer'];
            $product['warranty'] = $parameter->warranty;
            $product['device_id'] = $parameter->device_id;

        return $product;
    }


}