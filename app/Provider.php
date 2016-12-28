<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /**
     * Fillable fields
     * 
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'published',
    ];

    public function datacenter()
	{
		return $this->hasMany('App\Datacenter');
	}

	public function server()
	{
		return $this->hasMany('App\Server');
	}
    
}
