<?php

namespace VNPCMS\Orders;

use Illuminate\Support\Facades\App;
use VNPCMS\Orders\Orders;
use VNPCMS\Orders\Repository\OrdersRepositoryInterface;

class OrdersApplicationService
{

    /**
     * Create new Articles
     *
     * @return array
     *
     * @return Articles
     **/
    public function create($cate)
    {
        $cateRepository = App::make(OrdersRepositoryInterface::class);
        $cates = $cateRepository->create($cate);

        return $cates;
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
        $catesRepository = App::make(OrdersRepositoryInterface::class);
        $catesRepository->deleteByid($id);
    }


    /**
     * Update Articles
     *
     * @param Articles
     * @param array attributes
     *
     * @return void
     **/
    public function update(Orders $id, array $attributes)
    {
        $catesRepository = App::make(OrdersRepositoryInterface::class);
        $catesRepository->update($id, $attributes);
    }

}