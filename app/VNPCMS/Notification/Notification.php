<?php

namespace VNPCMS\Notification;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    public $timestamps = true;

    const USER_SYSTEMS   = 1;
    const USER_ORDER   = 2;
    const USER_PACKAGE   = 3;
    const USER_CONMPLAINT  = 4;
    const USER_MEMBER  = 5;
    const ADMIN_SYSTEMS   = 6;
    const ADMIN_ORDER   = 7;
    const ADMIN_PACKAGE   = 8;
    const ADMIN_CONMPLAINT  = 9;

    protected $fillable = ['title','slug','short','content','user_id','type','status','is_usergroup','group','is_send'];
}
