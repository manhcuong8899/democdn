<?php

namespace VNPCMS\Complaints;

use Illuminate\Support\Facades\App;
use VNPCMS\Complaints\Complaints;
use VNPCMS\Complaints\Repository\ComplaintsRepositoryInterface;

class ComplaintsApplicationService
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
        $cateRepository = App::make(ComplaintsRepositoryInterface::class);
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
        $catesRepository = App::make(ComplaintsRepositoryInterface::class);
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
    public function update(Complaints $id, array $attributes)
    {
        $catesRepository = App::make(ComplaintsRepositoryInterface::class);
        $catesRepository->update($id, $attributes);
    }

}