<?php

namespace VNPCMS\Banks;

use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    protected $table = 'bank';
    public $timestamps = true;

    protected $fillable = [
        'banknumber',
        'accountbank',
        'branch',
        'cate_id',
        'order',
        'locale',
        'customer_id',
        'status',
    ];

    public function cates() {
        return $this->hasOne('VNPCMS\CateArticle\CateArticles','id', 'cate_id');
    }
}
