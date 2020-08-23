<?php
namespace VNPCMS\Products\Repository;
use VNPCMS\Products\Repository\ProductsRepositoryInterface;
use VNPCMS\Products\Products;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentProductsRepository implements ProductsRepositoryInterface
{
    private $productsRepository;

    private $cache;

    public function __construct(ProductsRepositoryInterface $productsRepository, Cache $cache)
    {
        $this->productsRepository = $productsRepository;
        $this->cache = $cache;
    }

    /**

     */
    public function getAll()
    {
        return $this->cache->tags('products')->rememberForever('products.all', function (){
            return $this->productsRepository->getAll();
        });
    }

    /**

     */
    public function create($attributes)
    {
        return $this->productsRepository->create($attributes);
    }

    /**

     */

    public function ById($id)
    {
        return $this->cache->tags('products')->rememberForever('products.ById.'.$id, function () use ($id) {
            return $this->productsRepository->ById($id);
        });
    }

    /**

     */

    public function ProductNull($name,$code)
    {
        return $this->cache->tags('products')->rememberForever('products.ProductNull.'.$name.$code, function () use ($name,$code) {
            return $this->productsRepository->ProductNull($name,$code);
        });
    }

    public function ProductNullUpdate($name,$code,$id)
    {
        return $this->cache->tags('products')->rememberForever('products.ProductNullUpdate.'.$name.$code.$id, function () use ($name,$code,$id) {
            return $this->productsRepository->ProductNullUpdate($name,$code,$id);
        });
    }

    /**

     */

    public function deleteById($id)
    {
        return $this->productsRepository->deleteById($id);
    }
    public function deleteByall($slug_name)
    {
        return $this->productsRepository->deleteByall($slug_name);
    }

    /**

     */
    public function update(Products $product, array $attributes)
    {
        return $this->productsRepository->update($product,$attributes);
    }

    /**

     */

    public function ByCate($id)
    {
        return $this->cache->tags('products')->rememberForever('products.ByCate.'.$id, function () use ($id) {
            return $this->productsRepository->ByCate($id);
        });
    }

    public function ByGroup($id,$cate)
    {
           return $this->cache->tags('products')->rememberForever('products.ByGroup.'.$id.$cate, function () use ($id,$cate) {
            return $this->productsRepository->ByGroup($id,$cate);
        });
    }

    public function ByAlso($cateid)
    {
        return $this->cache->tags('products')->rememberForever('products.ByAlso.'.$cateid, function () use ($cateid) {
            return $this->productsRepository->ByAlso($cateid);
        });
    }

    public function GetDetail($slug)
    {
        return $this->cache->tags('products')->rememberForever('products.GetDetail.'.$slug, function () use ($slug) {
            return $this->productsRepository->GetDetail($slug);
        });
    }

}
