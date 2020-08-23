<?php

namespace VNPCMS\Article;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'article';
    public $timestamps = true;

    protected $fillable = ['name','slug','images','short','long','mode','status','group','locale','cate_id','order','keywords','description'];

    public function cates() {
        return $this->hasOne('VNPCMS\CateArticle\CateArticles','id', 'cate_id');
    }
}
