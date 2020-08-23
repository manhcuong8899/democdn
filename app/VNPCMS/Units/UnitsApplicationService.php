<?php

namespace VNPCMS\Units;

use Illuminate\Support\Facades\App;
use VNPCMS\Units\Units;
use VNPCMS\Units\Repository\UnitsRepositoryInterface;

class UnitsApplicationService
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
        $cateRepository = App::make(UnitsRepositoryInterface::class);
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
        $catesRepository = App::make(UnitsRepositoryInterface::class);
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
    public function update(Units $id, array $attributes)
    {
        $catesRepository = App::make(UnitsRepositoryInterface::class);
        $catesRepository->update($id, $attributes);
    }

}