<?php

namespace VNPCMS\Property;

use Illuminate\Support\Facades\App;
use VNPCMS\Property\Properties;
use VNPCMS\Property\Repository\PropertiesRepositoryInterface;

class PropertiesApplicationService
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
        $cateRepository = App::make(PropertiesRepositoryInterface::class);
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
        $catesRepository = App::make(PropertiesRepositoryInterface::class);
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
    public function update(Properties $id, array $attributes)
    {
        $catesRepository = App::make(PropertiesRepositoryInterface::class);
        $catesRepository->update($id, $attributes);
    }

}