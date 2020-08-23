<?php
use VNPCMS\Products\Products;

function viewProduct($id)
{
    $group = \App\Models\Groupproducts::find($id);

    if(json_decode($group->group_cate)!=null){
        $gp = json_decode($group->group_cate);
       /* $products = Products::whereIn('cate_id',$gp)->groupBy('products.name')->limit(100)->get();*/
        $products = Products::whereIn('cate_id',$gp)->limit(12)->get();
        return $products;
    }else{
        $gp = json_decode($group->group_product);
        $products = Products::whereIn('id',$gp)->limit(12)->get();
        return $products;
    }
}

function CheckInvail($id)
{
   $null = Products::find($id);
    if($null!=null){
        return true;
    }
    return false;
}
?>