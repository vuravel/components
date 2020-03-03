<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;

class Childobj extends Model
{	
	public function obj()
	{
		return $this->belongsTo('Vuravel\Components\Tests\Models\Obj'); 
	}

}
