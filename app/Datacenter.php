<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Provider;
use App\Server;
use App\Country;

class Datacenter extends Model {


	protected $fillable = [
        'name', 'code', 'provider_id', 'country_id', 'description', 'published',
    ];


	public function country()
	{
		return $this->belongsTo('App\Country');
	}

	public function countries()
	{
		return Country::pluck('name', 'id');
	}

	public function provider()
	{
		return $this->belongsTo('App\Provider');
	}

	public function providers()
	{
		return Provider::pluck('name', 'id');
	}

	public function server()
	{
		return $this->hasMany('App\Server');
	}

}