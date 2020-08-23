<?php
/**
 * Created by PhpStorm.
 * User: CUONGHM
 * Date: 8/23/2016
 * Time: 4:06 PM
 */

namespace App\Utils;
use Cart;


class Carts {

    public static function getTotal()
        {
            $cart = Cart::content();
            $total=0;
            foreach ($cart as $index=>$value)
            {
                $total = $total + $value->qty*$value->price*((100-$value->saleoff)/100);
            }
            return $total;
        }

    public static function destroy()
    {
        Cart::destroy();
    }

}