<?php

namespace VNPCMS\Notification;

use Illuminate\Database\Eloquent\Model;

class TypeNotification extends Model
{
    protected $table = 'type_notification';
    public $timestamps = true;

    protected $fillable = ['name','code','status','group'];

    public function notifications()
    {
        return $this->hasMany('VNPCMS\Notification\Notification','type','id');
    }
}
