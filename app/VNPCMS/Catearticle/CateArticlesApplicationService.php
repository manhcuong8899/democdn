<?php

namespace VNPCMS\Catearticle;

use Illuminate\Support\Facades\App;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;

class CateArticlesApplicationService
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
        $cateRepository = App::make(CateArticlesRepositoryInterface::class);
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
        $catesRepository = App::make(CateArticlesRepositoryInterface::class);
        $subcate = $catesRepository->FindSubCate($id);
        if($subcate!="")
        {
            $catesRepository->deleteAllId($subcate);
        }

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
    public function update(CateArticles $id, array $attributes)
    {
        $catesRepository = App::make(CateArticlesRepositoryInterface::class);
        $catesRepository->update($id, $attributes);
    }

}