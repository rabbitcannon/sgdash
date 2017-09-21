<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'name', 'email', 'password',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role() {
        return $this->hasOne('App\UsersRoles', 'user_id', 'id');
    }

    /**
     * @return bool
     */
    public function adminCheck() {
        $check = UsersRoles::where('user_id', $this->id)->first();

        if($check->role_id === 1) {
            $admin = (bool) true;
        }
        else {
            $admin = (bool) false;
        }
        return $admin;
    }


    /**
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeManager($query, $type) {
        $term = ucwords($type) . " Manager";
        $id = Role::where('name', $term)->pluck('id');
        return $query->whereHas('role', function ($query) use ($id) { $query->where('role_id', '=', $id); })->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany('App\Comment', 'user_id');
    }
}
