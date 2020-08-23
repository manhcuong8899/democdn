<?php

namespace VNPCMS\Property;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table = 'properties';
    public $timestamps = true;

    protected $fillable = ['value','cate_id','locale','status'];

    public function cates() {
        return $this->hasOne('VNPCMS\CateArticle\CateArticles', 'id', 'cate_id');
    }
}
