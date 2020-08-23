<?php
namespace VNPCMS\Property\Repository;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Property\Properties;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use App;
use App\Models\Join_property;

class EloquentPropertiesRepository implements PropertiesRepositoryInterface
{
    /**
     * All Settings
     *
     * @return Collection
     */
    public function getByGroup($group)
    {
        $id = CateArticles::where('code',$group)->first()->id;

        return Properties::orderBy('created_at','asc')
            ->where('cate_id',$id)
            ->where('locale',getCurrentSessionAppLocale())
            ->paginate(15);
    }

    public function getAll()
    {
        $cate_property = App::make(CateArticlesRepositoryInterface::class);
        $cate_property = $cate_property->getByGroup('properties',0);
        $properties = array();
        foreach($cate_property as $cate)
        {
            $property = $this->FindByCateId($cate->id);
            $properties[$cate->code] = json_encode($property);
        }
        return $properties;
    }

    /**
     * Create new Setting
     *
     * @param $attributes
     *
     * @return Setting
     */

    public function PropertyForCates($cates,$property)
    {
        if(!empty($cates)){
            foreach($cates as $value){
                $join = new Join_property();
                $join->cate_id = $value;
                $join->property_id = $property;
                $join->save();
            }
        }
    }


    public function PropertyNull($value,$cate)
    {
        $checkname = Properties::where('value',$value)->where('cate_id',$cate)->count();
        if($checkname!=0)
        {
            return false;
        }
        return true;
    }

    public function PropertyNullUpdate($value,$cate,$id)
    {
        $checkname = Properties::where('value',$value)->where('cate_id',$cate)->where('id','!=',$id)->count();
        if($checkname!=0)
        {
            return false;
        }
        return true;
    }
    /**
    Hàm xóa các thuộc tính thuộc danh mục    */
    public function deleteAllCate($property)
    {
            $roperties = Join_property::where('property_id',$property)->delete();
    }


    /**
     * Create new Setting
     *
     * @param $attributes
     *
     * @return Setting
     */
    public function create($attributes)
    {
       Properties::create($attributes);
    }

    /**
     * Delete Setting by key
     *
     * @param $key
     */

    public function ById($id)
    {
        return Properties::find($id);
    }

    public function FindByCateId($id)
    {
        return Properties::select('value','id','status')->orderBy('value','asc')
            ->where('cate_id',$id)
            ->where('locale',getCurrentSessionAppLocale())
            ->get()->toArray();
    }



    public function deleteById($id)
    {
        $cate = $this->ById($id);
        $cate->delete();
    }

    /**
     * Update Setting with given attributes
     *
     * @param Setting
     * @param value
     *
     * @return void
     */
    // Not limiting it to only single string value as attribute
    // for updating a setting, in the future there could be more
    // columns in the db for one setting rather than just key & value
    public function update(Properties $article, array $attributes)
    {
        $article->update($attributes);
    }
}
