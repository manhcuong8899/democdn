<?php

namespace VNPCMS\Products;

use Illuminate\Support\Facades\App;
use VNPCMS\Products\Products;
use VNPCMS\Products\Repository\ProductsRepositoryInterface;

class ProductsApplicationService
{

    /**
     * Create new Articles
     *
     * @return array
     *
     * @return Articles
     **/
    public function create($product)
    {
        $productsRepository = App::make(ProductsRepositoryInterface::class);
        $products = $productsRepository->create($product);

        return $products;
    }

    /**
     * Delete Articles by ID
     *
     * @param key
     *
     * @return void
     **/
    public function delete($id)
    {
        $productsRepository = App::make(ProductsRepositoryInterface::class);
        $productsRepository->deleteByid($id);
    }

    public function deleteall($slug_name)
    {
        $productsRepository = App::make(ProductsRepositoryInterface::class);
        $productsRepository->deleteByall($slug_name);
    }

    /**
     * Update Articles
     *
     * @param Articles
     * @param array attributes
     *
     * @return void
     **/
    public function update(Products $id, array $attributes)
    {
        $productsRepository = App::make(ProductsRepositoryInterface::class);
        $productsRepository->update($id, $attributes);
    }

}