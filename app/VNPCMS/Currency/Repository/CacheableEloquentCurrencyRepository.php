<?php
namespace VNPCMS\Currency\Repository;
use VNPCMS\Currency\Repository\CurrencyRepositoryInterface;
use VNPCMS\Currency\Currency;
use Illuminate\Contracts\Cache\Repository as Cache;


class CacheableEloquentCurrencyRepository implements CurrencyRepositoryInterface
{
    private $CurrencyRepository;

    private $cache;

    public function __construct(CurrencyRepositoryInterface $CurrencyRepository, Cache $cache)
    {
        $this->CurrencyRepository = $CurrencyRepository;
        $this->cache = $cache;
    }
    /**
     * Create new setting.
     *
     * @param array attributes
     *
     * @return Setting
     */
    public function create($attributes)
    {
        return $this->CurrencyRepository->create($attributes);
    }

    /**
     * Delete setting by key
     *
     * @param $key
     */


    public function byId($id)
    {
        return $this->cache->tags('Currency')->rememberForever('Currency.byId.'.$id, function () use ($id) {
            return $this->CurrencyRepository->byId($id);
        });
    }

    public function GetAll()
    {
        return $this->cache->tags('Currency')->rememberForever('Currency.all', function (){
            return $this->CurrencyRepository->GetAll();
        });
    }

    public function CurrencyNull($code)
    {
        return $this->cache->tags('Currency')->rememberForever('Currency.CurrencyNull', function () use ($code) {
            return $this->CurrencyRepository->CurrencyNull($code);
        });
    }

    public function CurrencyNullUpdate($code,$id)
    {
        return $this->cache->tags('Currency')->rememberForever('Currency.CurrencyNull.'.$code.$id, function () use ($code,$id) {
            return $this->CurrencyRepository->CurrencyNullUpdate($code,$id);
        });
    }


    public function deleteById($id)
    {
        return $this->CurrencyRepository->deleteById($id);
    }



    /**
     * Update setting by given value.
     *
     * @param Setting
     * @param array atributes
     */
    public function update(Currency $Currency, array $attributes)
    {
        return $this->CurrencyRepository->update($Currency,$attributes);
    }
}
