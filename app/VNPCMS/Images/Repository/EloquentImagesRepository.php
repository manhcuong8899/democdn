<?php
namespace VNPCMS\Images\Repository;
use VNPCMS\Images\Images;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentImagesRepository implements ImagesRepositoryInterface
{
    /**
     * All Settings
     *
     * @return Collection
     */
    public function getByGroup($group)
    {
        $images = Join::join('cate_article', 'join.cate_id', '=', 'cate_article.id')
            ->join('images', 'join.join_id', '=', 'images.id')
            ->select('images.*')
            ->where('cate_article.code',$group)
            ->groupBy('join.join_id','products.id')
            ->paginate(15);
        return $images;
    }

    public function getAll()
    {
        $images =Images::orderBy('created_at', 'DESC')->paginate(25);
        return $images;
    }

    public function getSeach($categories)
    {
        $images =Images::orderBy('created_at', 'DESC')->where('cate_id',$categories)->paginate(25);
        return $images;
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
       Images::create($attributes);
    }

    /**
     * Delete Setting by key
     *
     * @param $key
     */

    public function ById($id)
    {
        return Images::find($id);
    }


    public function ByPosition($group,$position)
    {

    }


    public function deleteById($id)
    {
        $image = $this->ById($id);
        $image->delete();
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
    public function update(Images $image, array $attributes)
    {
        $image->update($attributes);
    }
}
