<?php
namespace VNPCMS\Products\Repository;
use App\Models\Groupproducts;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Products\Products;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Join;
use App\Models\Join_mode;

class EloquentProductsRepository implements ProductsRepositoryInterface
{
    /**

     */
    public function getAll()
    {
        return Products::orderBy('created_at','desc')
           /* ->where('locale',getCurrentSessionAppLocale())->groupBy('name')*/
            ->where('locale',getCurrentSessionAppLocale())
            ->paginate(25);
    }
    /**

     */
    public function create($attributes)
    {
       return Products::create($attributes);
    }

    /**

     */

    public function ById($id)
    {
        return Products::find($id);
    }
    /**

     */
    public function ProductNull($model,$color){

        $check = Products::where('model',$model)->where('color',$color)->count();

        if($check!=0) {
            return false;
        }
        return true;
    }
    /**

     */
    public function ProductNullUpdate($model,$color,$id){

        $check = Products::where('model',$model)->where('color',$color)->where('id','!=',$id)->count();

        if($check!=0) {
            return false;
        }
        return true;
    }
    /**

     */
    public function deleteById($id)
    {
        $product = $this->ById($id);
        $product->delete();
        Join_mode::where('item_id',$id)->where('group','products')->delete();
    }

    public function deleteByall($slug_name)
    {
        $product = Products::where('slug_name',$slug_name)->delete();
    }

    /**

     */

    public function update(Products $products, array $attributes)
    {
        $products->update($attributes);
    }

    /**
FONT END
     */
    public function ByCate($cate)
    {

        if($cate!=null)
        {
            $allquery = $cate->mergechildren($cate);
            $products = Products::whereIn('cate_id',$allquery)
               /* ->groupBy('products.name')*/
                ->paginate(35);
            return $products;
        }

    }

    public function ByGroup($group,$cate)
    {

        /* Group theo danh muc san pham */
        if($group->group_cate!='0')
        {
            $allquery = $cate->mergechildren($cate);
            $group = json_decode($group->group_cate);
            if($cate!=null)
            {
                $products = Products::whereIn('cate_id',$allquery)
                    ->where(function ($query) use ($group) {
                        $query->whereIn('cate_id', $group);
                    })
                    ->groupBy('products.name')
                    ->paginate(25);
                return $products;
            }

        }
        /* Group theo san pham */
        $group = json_decode($group->group_product);
        $products = Products::whereIn('id',$group)
            ->groupBy('products.name')
            ->paginate(25);
        return $products;

    }

    /* ---------- */

    public function ByAlso($cateid)
    {
        $cate = CateArticles::find($cateid);
        if($cate!=null)
        {
            $allquery = $cate->mergechildren($cate);
            $products = Products::whereIn('cate_id',$allquery)
                ->paginate(8);
            return $products;
        }

    }



    public function GetDetail($slug)
    {
        $details = Products::where('slug',$slug)->firstOrFail();
        return $details;
    }
}
