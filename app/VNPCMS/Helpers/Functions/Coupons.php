<?php


function CateCoupon($group_cate,$cate_product)
{
    $check = false;
    $cate = json_decode($group_cate);
    if(in_array($cate_product,$cate)==true){
        $check = true;
    }
    return $check;
}

function ProductCoupon($group_product,$product_id)
{
    $check = false;
    $products = json_decode($group_product);
    if(in_array($product_id,$products)==true){
        $check = true;
    }
    return  $check;
}

?>