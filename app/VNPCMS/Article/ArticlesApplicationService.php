<?php

namespace VNPCMS\Article;

use Illuminate\Support\Facades\App;
use VNPCMS\Article\Articles;
use VNPCMS\Article\Repository\ArticlesRepositoryInterface;

class ArticlesApplicationService
{

    /**
     * Create new Articles
     *
     * @return array
     *
     * @return Articles
     **/
    public function create($article)
    {
        $articlesRepository = App::make(ArticlesRepositoryInterface::class);
        $articles = $articlesRepository->create($article);

        return $articles;
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
        $articlesRepository = App::make(ArticlesRepositoryInterface::class);
        $articlesRepository->deleteByid($id);
    }

    /**
     * Update Articles
     *
     * @param Articles
     * @param array attributes
     *
     * @return void
     **/
    public function update(Article $id, array $attributes)
    {
        $articlesRepository = App::make(ArticlesRepositoryInterface::class);
        $articlesRepository->update($id, $attributes);
    }

}