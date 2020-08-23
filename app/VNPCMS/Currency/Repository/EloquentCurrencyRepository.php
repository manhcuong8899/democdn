<?php
namespace VNPCMS\Currency\Repository;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Currency\Currency;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use App;
use App\Models\Join_Currency;

class EloquentCurrencyRepository implements CurrencyRepositoryInterface
{

    /**
     * Create new Setting
     *
     * @param $attributes
     *
     * @return Setting
     */
    public function create($attributes)
    {
       Currency::create($attributes);
    }

    /**
     * Delete Setting by key
     *
     * @param $key
     */

    public function ById($id)
    {
        return Currency::find($id);
    }

    public function GetAll()
    {
        return Currency::orderBy('code','asc')->get();
    }


    public function CurrencyNull($code)
    {
        $null = Currency::where('code',$code)->count();
        if($null!=0)
        {
            return false;
        }
        return true;
    }

    public function CurrencyNullUpdate($code,$id)
    {
        $null = Currency::where('code',$code)->where('id','!=',$id)->count();
        if($null!=0)
        {
            return false;
        }
        return true;
    }


    public function deleteById($id)
    {
        $cate = $this->ById($id);
        $cate->delete();
    }

    // Not limiting it to only single string value as attribute
    // for updating a setting, in the future there could be more
    // columns in the db for one setting rather than just key & value
    public function update(Currency $article, array $attributes)
    {
        $article->update($attributes);
    }
}
