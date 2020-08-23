<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    protected $fillable = [
        'birthday',
        'gender',
        'phone',
        'address',
        'city',
        'website',
        'facebook_username',
        'google_username',
        'biography',
        'user_id',
    ];

    /**
     * Relation between a profile and the user.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
