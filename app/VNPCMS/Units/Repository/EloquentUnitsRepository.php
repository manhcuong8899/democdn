<?php
namespace VNPCMS\Units\Repository;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Units\Units;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use App;
use App\Models\Join_Units;

class EloquentUnitsRepository implements UnitsRepositoryInterface
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
       Units::create($attributes);
    }

    /**
     * Delete Setting by key
     *
     * @param $key
     */

    public function ById($id)
    {
        return Units::find($id);
    }

    public function GetAll()
    {
        return Units::orderBy('name','asc')->get();
    }


    public function UnitsNull($name)
    {
        $null = Units::where('name',$name)->count();
        if($null!=0)
        {
            return false;
        }
        return true;
    }

    public function UnitsNullUpdate($name,$id)
    {
        $null = Units::where('name',$name)->where('id','!=',$id)->count();
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
    public function update(Units $article, array $attributes)
    {
        $article->update($attributes);
    }
}
