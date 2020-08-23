<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use VNPCMS\Catearticle\CateArticles;

class Join_property extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;

    protected $table = 'join_property';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id',
        'cate_id',
    ];


    public function code($cateid)
    {
       $code = CateArticles::find($cateid)->code;
        return $code;
    }


}
