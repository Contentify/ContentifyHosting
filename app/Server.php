<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Datacenter;
use App\Provider;

class Server extends Model
{

	public static $tags = ['web', 'contentify', 'team', 'organisation', 'production', 'developpement'];

	protected $casts = [
    	'tags' => 'array', // Will convarted to (Array)
	];

	protected $fillable = [
        'name', 'tags', 'description', 'user_id', 'provider_id', 'datacenter_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
	{
		return User::pluck('name', 'id');
	}

	public function provider()
	{
		return $this->belongsTo('App\Provider');
	}

	public function providers()
	{
		return Provider::pluck('name', 'id');
	}

	public function datacenter()
	{
		return $this->belongsTo('App\Datacenter');
	}

	public function datacenters()
	{
		return Datacenter::pluck('name', 'id');
	}

	/**
     * Returns an array that uses the values of another array as values and keys.
     * 
     * @param  string $attribute The name of thea ttribute that contains the source array
     * @return array
     */
    public static function makeOptionArray($attribute) 
    {
        $originalArray = self::$$attribute;

        $array = [];

        foreach ($originalArray as $value) {
            $array[$value] = $value;
        }

        return $array;
    }


}
