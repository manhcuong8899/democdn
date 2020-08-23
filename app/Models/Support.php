<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;


    protected $table = 'support';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
        'skype',
        'name',
        'email',
        'cate_id',
        'order',
        'status',
    ];
    public function cates() {
        return $this->hasOne('VNPCMS\CateArticle\CateArticles', 'id', 'cate_id');
    }

}
