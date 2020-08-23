<?php

namespace VNPCMS\Images;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    public $timestamps = true;

    protected $fillable = ['name','url','short','images','position','status','locale','cate_id','order'];

    public function cates() {
        return $this->hasOne('VNPCMS\CateArticle\CateArticles','id', 'cate_id');
    }
}
