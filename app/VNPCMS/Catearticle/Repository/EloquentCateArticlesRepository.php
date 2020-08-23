<?php
namespace VNPCMS\Catearticle\Repository;
use VNPCMS\Catearticle\CateArticles;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use VNPCMS\Products\Products;

class EloquentCateArticlesRepository implements CateArticlesRepositoryInterface
{
    /**
     * All Settings
     *
     * @return Collection
     */
    public function getByGroup($group,$parent_id)
    {
        return CateArticles::orderBy('order','asc')
            ->where('group',$group)
            ->where('parent_id',$parent_id)
            ->where('locale',getCurrentSessionAppLocale())
            ->get();
    }

    public function getData($group)
    {
        return CateArticles::orderBy('order','asc')
            ->where('group',$group)
            ->where('locale',getCurrentSessionAppLocale())
            ->get()->toArray();
    }
    /**
     * Create new Setting
     *
     * @param $attributes
     *
     * @return Setting
     */

    /**
    Get status name of cate
     */
    public function getstatus_name($cates)
    {
        $name = array();
        foreach($cates as $value)
        {
            $status = $value->status;

            switch ($status) {
                case 1:
                    $name[$value->id] = trans('VNPCMS.forms.tables.content.active');
                    break;
                default:
                    $name[$value->id] = trans('VNPCMS.forms.tables.content.deactive');
            }

        }


        return $name;
    }

    /**
    Get status name of cate
     */
    public function getparent_name($cates)
    {
        $name = array();
        foreach($cates as $value)
        {
           $parentid = $value->parent_id;
            if($parentid!=Null)
            {
                $name[$value->id] = CateArticles::find($value->parent_id)->name;
            }
            else
            {
                $name[$value->id] = trans('VNPCMS.forms.tables.content.rootfoder');
            }
        }
        return $name;
    }

    /**
        Find Sub Cate
     */
    public function FindSubCate($id)
    {
        return CateArticles::where('parent_id',$id)->get();
    }

    /**
    Delete All SubCate
     */
    public function deleteAllId($cates)
    {
      foreach($cates as $value)
      {
          $this->deleteById($value->id);
      }
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
       CateArticles::create($attributes);
    }

    /**
     * Delete Setting by key
     *
     * @param $key
     */

    public function ById($id)
    {
        return CateArticles::find($id);
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
    public function update(CateArticles $article, array $attributes)
    {
        $article->update($attributes);
    }
}
