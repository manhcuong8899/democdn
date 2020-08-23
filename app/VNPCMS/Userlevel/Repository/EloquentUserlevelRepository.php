<?php
namespace VNPCMS\Userlevel\Repository;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Userlevel\Userlevel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use App;
use App\Models\Join_Userlevel;

class EloquentUserlevelRepository implements UserlevelRepositoryInterface
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
       Userlevel::create($attributes);
    }

    /**
     * Delete Setting by key
     *
     * @param $key
     */

    public function ById($id)
    {
        return Userlevel::find($id);
    }

    public function FindByCateId($id)
    {
        return Userlevel::orderBy('id','asc')
            ->where('cate_id',$id)
            ->get();
    }


    public function UserlevelNull($code,$cate_id)
    {
        $null = Userlevel::where('code',$code)->where('cate_id',$cate_id)->count();
        if($null!=0)
        {
            return false;
        }
        return true;
    }

    public function UserlevelNullUpdate($code,$cate_id,$id)
    {
        $null = Userlevel::where('code',$code)->where('cate_id',$cate_id)->where('id','!=',$id)->count();
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
    public function update(Userlevel $article, array $attributes)
    {
        $article->update($attributes);
    }
}
