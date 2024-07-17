<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'direccion',
        'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }

    public function bikes(){

        return $this->hasMany('\App\Models\Bike');
    }

    # Métoddo para indicar si un usuario tiene un rol concreto.
    public function hasRole($roleNames):bool{

        # Si solamente viene un ROL , lo mete en un array
        if(!is_array($roleNames))
            $roleNames = [$roleNames];

        # Recorre la lista de roles buscando...
        foreach($this->roles as $role){
            if(in_array($role->role, $roleNames))
                return true;
        }

        return false; # Si no lo encuentra
    }

    # Método para saber si un usuario es propietario de una moto
    
    public function isOwner(Bike $bike):bool{
        return $this->id == $bike->user_id;
    }

}
