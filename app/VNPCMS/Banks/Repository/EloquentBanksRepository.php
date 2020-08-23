<?php
namespace VNPCMS\Banks\Repository;
use VNPCMS\Banks\Banks;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class EloquentBanksRepository implements BanksRepositoryInterface
{
    /**
     * All Settings
     *
     * @return Collection
     */
    public function getByGroup($group)
    {
        $Banks = Join::join('cate_article', 'join.cate_id', '=', 'cate_article.id')
            ->join('Banks', 'join.join_id', '=', 'Banks.id')
            ->select('Banks.*')
            ->where('cate_article.code',$group)
            ->groupBy('join.join_id','products.id')
            ->paginate(15);
        return $Banks;
    }

    public function getAll()
    {
        if(Auth::user()->hasRole('administrator')==false){
            return Banks::orderBy('created_at', 'DESC')
                ->where('customer_id',Auth::user()->id)
                ->get();
        }
        return Banks::orderBy('created_at', 'DESC')
            ->where('customer_id',0)
            ->get();

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
       Banks::create($attributes);
    }

    /**
     * Delete Setting by key
     *
     * @param $key
     */

    public function ById($id)
    {
        return Banks::find($id);
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
    public function update(Banks $image, array $attributes)
    {
        $image->update($attributes);
    }
}
