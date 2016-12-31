<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Provider;

class Plan extends Model
{

    /**
     * Fillable fields
     * 
     * @var array
     */
    protected $fillable = [
        'name', 'interval', 'amount', 'braintree_id', 'provider_id', 'description', 'published'
    ];

    

    public function provider()
	{
		return $this->belongsTo('App\Provider');
	}

	public function providers()
	{
		return Provider::pluck('name', 'id');
	}

}
