<?php

namespace VNPCMS\Userlevel;

use Illuminate\Database\Eloquent\Model;

class Userlevel extends Model
{
    protected $table = 'user_level';
    public $timestamps = true;

    protected $fillable = ['value','code','name','cate_id'];
    public function cates() {
        return $this->hasOne('VNPCMS\CateArticle\CateArticles', 'id', 'cate_id');
    }
}
