<?php namespace Modules\Users\Src\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Ultraware\Roles\Traits\HasRoleAndPermission as RoleTrait;
use  Ultraware\Roles\Contracts\HasRoleAndPermission;

use Ultraware\Roles\Models\Role;
class User extends Authenticatable implements HasRoleAndPermission
{
    use Notifiable;
    use RoleTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'activated','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getFullnameAttribute()
    {
        return $this->attributes['first_name']." ".$this->attributes['last_name'];
    }
}
