<?php
namespace VNPCMS\Catearticle\Repository;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use VNPCMS\Catearticle\CateArticles;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentCateArticlesRepository implements CateArticlesRepositoryInterface
{
    private $CateArticleRepository;

    private $cache;

    public function __construct(CateArticlesRepositoryInterface $CateArticleRepository, Cache $cache)
    {
        $this->CateArticleRepository = $CateArticleRepository;
        $this->cache = $cache;
    }

    /**
     * All settings cached.
     *
     * @return Collection
     */
    public function getByGroup($group,$parent_id)
    {
        return $this->cache->tags('catearticles')->rememberForever('catearticles.all', function () use ($group,$parent_id) {
            return $this->CateArticleRepository->getByGroup($group,$parent_id);
        });
    }

    public function getData($group)
    {
        return $this->cache->tags('catearticles')->rememberForever('catearticles.data', function () use ($group) {
            return $this->CateArticleRepository->getData($group);
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
        return $this->CateArticleRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */

    public function getstatus_name($cates)
    {

        return $this->cache->tags('cate_article')->rememberForever('cate_article.status_name.'.$cates, function () use ($cates) {
            return $this->CateArticleRepository->getstatus_name($cates);
        });

    }

    /**
    Get status name of cate
     */
    public function getparent_name($cates)
    {
        return $this->cache->tags('catearticles')->rememberForever('catearticles.parent_name.'.$cates, function () use ($cates) {
            return $this->CateArticleRepository->getparent_name($cates);
        });
    }

    public function FindSubCate($parent_id)
    {
        return $this->cache->tags('cate_article')->rememberForever('cate_article.subcate.'.$parent_id, function () use ($parent_id) {
            return $this->CateArticleRepository->FindSubCate($parent_id);
        });
    }


    public function byId($id)
    {
        return $this->cache->tags('cate_article')->rememberForever('cate_article.byId.'.$id, function () use ($id) {
            return $this->CateArticleRepository->byId($id);
        });
    }


    public function deleteById($id)
    {
        return $this->CateArticleRepository->deleteById($id);
    }

    public function deleteAllId($cates)
    {
        return $this->CateArticleRepository->deleteAllId($cates);
    }

    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(CateArticles $catearticle, array $attributes)
    {
        return $this->CateArticleRepository->update($catearticle,$attributes);
    }
}
