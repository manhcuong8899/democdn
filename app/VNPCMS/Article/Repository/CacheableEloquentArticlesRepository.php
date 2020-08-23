<?php
namespace VNPCMS\Article\Repository;
use VNPCMS\Article\Repository\ArticlesRepositoryInterface;
use VNPCMS\Article\Articles;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentArticlesRepository implements ArticlesRepositoryInterface
{
    private $articleRepository;

    private $cache;

    public function __construct(ArticlesRepositoryInterface $articleRepository, Cache $cache)
    {
        $this->articleRepository = $articleRepository;
        $this->cache = $cache;
    }

    /**
     * All settings cached.
     *
     * @return Collection
     */
    public function getByGroup($group)
    {
        return $this->cache->tags('article')->rememberForever('article.all', function () use ($group) {
            return $this->articleRepository->getByGroup($group);
        });
    }

    public function getBySeach($group,$categories,$text)
    {
        return $this->cache->tags('article')->rememberForever('article.seach', function () use ($group,$categories,$text) {
            return $this->articleRepository->getBySeach($group,$categories,$text);
        });
    }

    /**
     * Get setting by key cached.
     *
     * @param $key
     */

    /**
     * Create new setting.
     *
     * @param array attributes
     *
     * @return Setting
     */
    public function create($attributes)
    {
        return $this->articleRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */

    public function byId($id)
    {
        return $this->cache->tags('article')->rememberForever('article.byId.'.$id, function () use ($id) {
            return $this->articleRepository->byId($id);
        });
    }

    public function ArticleNull($name)
    {
        return $this->cache->tags('article')->rememberForever('article.ArticleNull.'.$name, function () use ($name) {
            return $this->articleRepository->ArticleNull($name);
        });
    }


    public function ArticleNullUpdate($name,$id)
    {
        return $this->cache->tags('article')->rememberForever('article.ArticleNullUpdate.'.$name.$id, function () use ($name,$id) {
            return $this->articleRepository->ArticleNullUpdate($name,$id);
        });
    }

    public function byName($name)
    {
        return $this->cache->tags('article')->rememberForever('article.byName.'.$name, function () use ($name) {
            return $this->articleRepository->byName($name);
        });
    }


    public function deleteById($id)
    {
        return $this->articleRepository->deleteById($id);
    }

    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Articles $article, array $attributes)
    {
        return $this->articleRepository->update($article,$attributes);
    }
}
