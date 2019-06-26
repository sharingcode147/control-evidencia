<?php

namespace App;

use App\Role;
use App\Profesor;
use App\Carrera;
use App\ProfesorCarrera;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function datos_profesor($run,$nombre1,$nombre2,$apellido1,$apellido2,$user_id)
    {
        $profesor = new Profesor;
        $profesor->run = $run;
        $profesor->nombre1 = $nombre1;
        $profesor->nombre2 = $nombre2;
        $profesor->apellido1 = $apellido1;
        $profesor->apellido2 = $apellido2;
        $profesor->user_id = $user_id;
        $profesor->save();
    }

    public function profesor_carrera($run,$codigo_car)
    {
        $prof_car = new ProfesorCarrera;
        $prof_car->profesor_run = $run;
        $prof_car->codigo_car = $codigo_car;
        $prof_car->save();
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);    return true;
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } 
        else {
            if ($this->hasRole($roles)) {
                return true; 
            }   
        }    return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }    
        return false;
    }
}
