<?php

namespace VNPCMS\Userlevel;

use Illuminate\Support\Facades\App;
use VNPCMS\Userlevel\Userlevel;
use VNPCMS\Userlevel\Repository\UserlevelRepositoryInterface;

class UserlevelApplicationService
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
        $cateRepository = App::make(UserlevelRepositoryInterface::class);
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
        $catesRepository = App::make(UserlevelRepositoryInterface::class);
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
    public function update(Userlevel $id, array $attributes)
    {
        $catesRepository = App::make(UserlevelRepositoryInterface::class);
        $catesRepository->update($id, $attributes);
    }

}