<?php
namespace VNPCMS\Article\Repository;
use VNPCMS\Article\Articles;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Join;
use App\Models\Join_mode;

class EloquentArticlesRepository implements ArticlesRepositoryInterface
{
    /**
     * All Settings
     *
     * @return Collection
     */
    public function getByGroup($group)
    {
        return Articles::orderBy('order','asc')
            ->where('group',$group)
            ->where('locale',getCurrentSessionAppLocale())
            ->paginate(15);
    }

    public function getBySeach($group,$categories,$text)
    {
        $articles = Articles::orderBy('order','asc')->where(function ($query) use ($group,$text,$categories) {
                if($text!=""){
                    $query->where('name','LIKE','%'.$text.'%');
                }
                if($categories!=null){
                    $allquery = $categories->mergechildren($categories);
                    $query->whereIn('cate_id', $allquery);
                }
            })
            ->where('group',$group)
            ->where('locale',getCurrentSessionAppLocale())
            ->paginate(25);
        return $articles;
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
       return Articles::create($attributes);
    }

    public function ArticleNull($name)
    {
        $name = str_slug($name);

        $checkname = Articles::where('slug',$name)->count();
        if($checkname!=0)
        {
            return false;
        }
        return true;
    }

    public function ArticleNullUpdate($name,$id)
    {
        $name = str_slug($name);

        $checkname = Articles::where('slug',$name)->where('id','!=',$id)->count();
        if($checkname!=0)
        {
            return false;
        }
        return true;
    }

    /**
     * Delete Setting by key
     *
     * @param $key
     */

    public function ById($id)
    {
        return Articles::find($id);
    }

    public function ByName($name)
    {
        return Articles::where('name',$name)->first();
    }

    public function deleteById($id)
    {
        $article = $this->ById($id);
        $article->delete();
        Join_mode::where('item_id',$id)->where('group','articles')->delete();
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
    public function update(Articles $article, array $attributes)
    {
        $article->update($attributes);
    }
}
