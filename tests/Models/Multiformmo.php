<?php
namespace Vuravel\Components\Tests\Models;
use Illuminate\Database\Eloquent\Model;

class Multiformmo extends Model
{	
	public function obj() 
	{
		return $this->morphTo(); 
	}

}
