<?php
namespace App\Models;
use Eloquent;
use Illuminate\Auth\Authenticatable;

use App\Models\Profile;
use App\Traits\HasRole;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Models\Permission;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;

class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
    use HasRole;
	
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
        'type',
        'locale',
        'verified',
        'level',
        'last_login',
        'user_handle_id',
        'device_token',
        'device_type',
        'activecode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Generate email_token for user.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->email_token = str_random(30);
        });
    }

    /**
     * Verify user in db, since the user has verified
     * the email.
     */
    public function confirmEmail()
    {
        $this->verified = true;
        $this->email_token = null;

        $this->save();
    }

    /**
     * Set last login datetime.
     */
    public function setLastLogin()
    {
        $this->last_login = date('Y-m-d H:i:s');
        $this->save();

        $this->save();
    }

    /**
     * Set default locale.
     */
    public function setDefaultLocale($locale)
    {
        $this->locale = $locale;

        $this->save();
    }

    /**
     * Relation between a User and Role.
     *
     * @return Roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }



    public function userhandle() {
        return $this->hasOne('App\Models\User', 'id', 'user_handle_id');
    }
    /**
     * Relation between a user and the profile.
     *
     * @return Profile
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function levels() {
        return $this->hasOne('VNPCMS\CateArticle\CateArticles','code', 'level');
    }

    public function orders() {
        return $this->hasMany('App\Models\Order','creator_id', 'id');
    }


    public function packages() {
        return $this->hasMany('App\Models\Package','creator_id', 'id');
    }
    /**
     * Get users profile page path.
     *
     * @return string
     */
    public function profilePath()
    {
       if(Auth::user()->hasRole('administrator')==true)
       {
           return $this->hasProfile() ? url('admin/members/show/' . $this->email) : 'admin';
       }
        return $this->hasProfile() ? url('/') : '/';

    }

    /**
     * Check if user has profile.
     *
     * @return bool
     */
    public function hasProfile()
    {
        return $this->profile ? true : false;
    }

    /**
     * Check if user has profile.
     *
     * @return bool
     */
    public function isVerified()
    {
        return $this->verified == 1 ? true : false;
    }

    public function banks(){
        return $this->hasMany('VNPCMS\Banks\Banks','customer_id', 'id');
    }

    public function address(){
        return $this->hasMany('App\Models\Address','customer_id', 'id');
    }

}
