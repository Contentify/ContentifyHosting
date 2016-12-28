<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model 
{
	public $timestamps = false;

	protected $fillable = [
        'name', 'code',
    ];

	public function datacenter()
	{
		return $this->hasMany('Datacenter');
	}

}