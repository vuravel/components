<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;

class Multiformmm extends Model
{	
	public function obj() 
	{
		return $this->morphTo(); 
	}

}
