<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupperMenus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;

    protected $table = 'suppermenus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'link',
        'submenu',
        'cate_id',
        'order',
        'parent_id',
        'root_id',
        'bank',
        'type',
        'data',
        'url',
        'locale',
    ];
    public function parents()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order', 'asc');
    }

    public function parent()
    {
        return $this->hasOne(self::class,'id','parent_id');
    }

    public function hasChildren()
    {
        return $this->children ? true : false;
    }

    public function hasParent()
    {
        return $this->parent ? true : false;
    }

    public function nameurl()
    {
        return $this->hasOne('VNPCMS\CateArticle\CateArticles','id', 'url');
    }

    public function articlesurl()
    {
        return $this->hasOne('VNPCMS\Article\\Articles','id', 'url');
    }

    public function productsurl()
    {
        return $this->hasOne('VNPCMS\Products\Products','id', 'url');
    }

    public function root()
    {
        return $this->hasOne(self::class,'id','root_id');
    }
}
