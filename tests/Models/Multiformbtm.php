<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;

class Multiformbtm extends Model
{	
	public function objs() 
	{
		return $this->belongsToMany('Vuravel\Components\Tests\Models\Obj'); 
	}

}
