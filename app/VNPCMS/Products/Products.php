<?php

namespace VNPCMS\Products;

use Illuminate\Database\Eloquent\Model;
use Psy\Util\Str;
use VNPCMS\Catearticle\CateArticles;

class Products extends Model
{
    protected $table = 'products';
    public $timestamps = true;

    protected $fillable = ['name','code','price','listprice','images','short','long',
                            'mode','status','group','locale','cate_id','slug','order',
                            'model','quantity','size','color','weight','user_id','slug_name','brand','slug_brand','shortcate','longcate','description','keywords'];
/*
    public static function colors($slug_name)
    {
        $colors = Products::where('slug_name',$slug_name)->get();
        $c = array();
        foreach($colors as $value)
        {
            $c[$value->model]=$value->model;
        }
        $colors = count($c);
        return $colors;
    }

    public static function size($slug_name)
    {
        $listProduct = Products::where('slug_name',$slug_name)->get();
        $size = array();
        foreach($listProduct as $key=>$value)
        {
            $size[$key]=$value->size;
        }
        return $size;
    }*/

    public static function isaProduct($slug_name)
    {
        $Total = Products::where('slug_name',$slug_name)->get()->count();
        if($Total==1 || $Total==0){
            return true;
    }
        return false;
    }

    public static function shortcate($cateid)
    {
        $short = CateArticles::find($cateid);
        return $short;
    }
    public static function longcate($cateid)
    {
        $long = CateArticles::find($cateid);
        return $long;
    }

    public static function TotalQuantity($slug_name)
    {
        $Total=0;
        $listProduct = Products::select('quantity')->where('slug_name',$slug_name)->get();
        foreach ($listProduct as $value){
            $Total=$Total +$value->quantity;
        }
        return $Total;
    }

    public static function Models($name)
    {
        $models = Products::where('name',$name)->groupby('model')->get();
        return $models;
    }

    public function cates() {
        return $this->hasOne('VNPCMS\CateArticle\CateArticles','id', 'cate_id');
    }
}
