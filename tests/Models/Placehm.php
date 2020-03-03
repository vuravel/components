<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;

class Placehm extends Model
{
	public $fillable = ['address', 'lat', 'lng', 'external_id', 'street_number', 'street', 'city', 'state', 'country', 'postal_code'];

	public function obj() 
	{
		return $this->belongsTo('Vuravel\Components\Tests\Models\Obj'); 
	}

}
