<?php

namespace VNPCMS\Catearticle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\Join_property;
use VNPCMS\Property\Properties;
use App\Models\SupperMenus;
class CateArticles extends Model
{
    protected $table = 'cate_article';
    public $timestamps = true;

    protected $fillable = ['name','china','english','url','images','slug','short','status','group',
        'parent_id','locale','order','code','parent_slug','keywords','description'];

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function allparentRecursive() {
        $retCollect = collect([]);
        foreach ($this->parent()->get() as $aChild) {
            $retCollect = $retCollect->merge($this->parentAddCollection($aChild));
        }
        return $retCollect;
    }

    /* Hàm gộp các danh mục cha thành 1 mảng để fill vào dữ liệu */

    public function mergeparent($id) {
        $allparrent = $this->allparentRecursive();
        $sub = array();
        $all = array();
        $i=0;
        foreach($allparrent as $value)
        {
            $all[$i]=$value->id;
            $i++;
        }
        if(is_numeric($id)==false) {
            array_push($all,$id->id);
        }
        return $all;
    }

    private function parentAddCollection($aCate) {
        $retCollect = collect([]);
        $retCollect->push($aCate);
        foreach ($aCate->parent()->get() as $aChild) {
            $retCollect = $retCollect->merge($this->parentAddCollection($aChild));
        }
        return $retCollect;
    }

    /**
     * Relation between this menu and its children.
     *
     * @return Menu
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order', 'asc');
    }

    public function allChildrenRecursive() {
        $retCollect = collect([]);
        foreach ($this->children()->get() as $aChild) {
            $retCollect = $retCollect->merge($this->recursiveAddCollection($aChild));
        }
        return $retCollect;
    }

    private function recursiveAddCollection($aCate) {
        $retCollect = collect([]);
        $retCollect->push($aCate);
        foreach ($aCate->children()->get() as $aChild) {
            $retCollect = $retCollect->merge($this->recursiveAddCollection($aChild));
        }
        return $retCollect;
    }

    /**
     Gán hết toàn bộ các danh mục con và danh mục hiện tại vào 1 mảng
     */
    public function mergechildren($id) {
        $allparrent = $this->allChildrenRecursive();
        $sub = array();
        $all = array();
        $i=0;
        foreach($allparrent as $value)
        {
            $all[$i]=$value->id;
            $i++;
        }
        if(is_numeric($id)==false) {
            array_push($all,$id->id);
        }

        return $all;
    }

    /**
     * Check if menu has children
     *
     * @return bool
     */
    public function hasChildren()
    {
        return $this->children ? true : false;
    }

    /**
     * Check if menu has parent
     *
     * @return bool
     */
    public function hasParent()
    {
        return $this->parent ? true : false;
    }

    public function products()
    {
        return $this->hasMany('App\Models\join','id','cate_id')->count();
    }

    public function cateroperties()
    {
        return $this->hasMany('App\Models\join_property','cate_id','id');
    }

    public function getsize()
    {
        $size=null;
       $properties = $this->cateroperties()->get();
        foreach($properties as $value)
        {
            if($value->type=='size')
            {
                $size = CateArticles::find($value->property_id)->id;
                $size = Properties::where('cate_id',$size)->get();
            }
        }

        return $size;
    }

    public function getcolor()
    {
        $color=null;
        $properties = $this->cateroperties()->get();
            foreach($properties as $value)
            {
                if($value->type=='color')
                {
                    $color = CateArticles::find($value->property_id)->id;
                    $color = Properties::where('cate_id',$size)->get();
                }
            }
            return $color;
    }

    public function supports()
    {
        return $this->hasMany('App\Models\Support','cate_id','id');
    }
    public function hasmenu($id,$group)
    {
        $count = SupperMenus::where('url',$id)->where('type',$group)->get()->count();
        return $count;
    }

}
