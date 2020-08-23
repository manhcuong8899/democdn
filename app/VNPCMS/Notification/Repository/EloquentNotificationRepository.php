<?php
namespace VNPCMS\Notification\Repository;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Notification\Notification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use App;
use App\Models\Join_Notification;

class EloquentNotificationRepository implements NotificationRepositoryInterface
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
       Notification::create($attributes);
    }

    /**
     * Delete Setting by key
     *
     * @param $key
     */

    public function ById($id)
    {
        return Notification::find($id);
    }

    public function GetAll($type)
    {
        return Notification::orderBy('created_at','desc')->where('type',$type->id)->get();
    }


    public function NotificationNull($name)
    {
        $null = Notification::where('title',$name)->count();
        if($null!=0)
        {
            return false;
        }
        return true;
    }

    public function NotificationNullUpdate($name,$id)
    {
        $null = Notification::where('title',$name)->where('id','!=',$id)->count();
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
    public function update(Notification $article, array $attributes)
    {
        $article->update($attributes);
    }
}
