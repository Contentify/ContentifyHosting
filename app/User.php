<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{

    use Notifiable;
    use Billable;

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    protected $fillable = [
        'name', 'email', 'password', 'street', 'city', 'state', 'country', 'zip', 'phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return true if User is Admin
     *
     */
    public function isAdmin()
    {
        return $this->admin; // this looks for an admin column in your users table
    }

    public function server()
    {
        return $this->hasMany('Server');
    }
}
