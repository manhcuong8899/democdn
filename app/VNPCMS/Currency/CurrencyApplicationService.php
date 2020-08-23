<?php

namespace VNPCMS\Currency;

use Illuminate\Support\Facades\App;
use VNPCMS\Currency\Currency;
use VNPCMS\Currency\Repository\CurrencyRepositoryInterface;

class CurrencyApplicationService
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
        $cateRepository = App::make(CurrencyRepositoryInterface::class);
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
        $catesRepository = App::make(CurrencyRepositoryInterface::class);
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
    public function update(Currency $id, array $attributes)
    {
        $catesRepository = App::make(CurrencyRepositoryInterface::class);
        $catesRepository->update($id, $attributes);
    }

}